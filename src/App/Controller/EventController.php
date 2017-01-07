<?php

namespace App\Controller;

use Respect\Validation\Validator as V;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EventController extends Controller
{
    public function show(Request $request, Response $response, $id)
    {
        $event = $this->mongo->findById('event', $id);
        $eventWithChildren = [
            'name' => $event->name,
            'description' => $event->description,
            'begins_at' => $event->begins_at,
            'ends_at' => $event->ends_at,
            'children' => $this->mongo->where('event', ['parent_id' => $event->_id->__toString()])->toArray()
        ];

        return $this->view->render($response, 'Event/show.twig', [
            'event' => $eventWithChildren
        ]);
    }

    public function get(Request $request, Response $response)
    {
        $events = $this->mongo->findAll('event');

        $eventsWithParent = [];
        foreach ($events as $event) {
            $eventsWithParent[] = [
                '_id' => $event->_id,
                'name' => $event->name,
                'description' => $event->description,
                'begins_at' => $event->begins_at,
                'ends_at' => $event->ends_at,
                'parent' => $event->parent_id ? $this->mongo->findById('event', $event->parent_id) : null
            ];
        }

        return $this->view->render($response, 'Event/get.twig', [
            'events' => $eventsWithParent
        ]);
    }

    public function add(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $this->validator->validate($request, [
                'name' => V::notBlank(),
                'description' => V::notBlank(),
                'start_time' => V::date('H:i'),
                'end_time' => V::date('H:i'),
                'start_date' => V::date('d/m/Y'),
                'end_date' => V::date('d/m/Y')
            ]);

            $this->validator->validate($request, [
                'parent_id' => V::optional(V::alnum())
            ], [
                'alnum' => 'Invalid event'
            ]);

            $this->validator->validate($request, [
                'category_id' => V::notBlank()->alnum()
            ], [
                'notBlank' => 'Please select a category',
                'alnum' => 'Invalid category'
            ]);

            $this->validator->validate($request, [
                'point_id' => V::notBlank()->alnum()
            ], [
                'notBlank' => 'Please select a location',
                'alnum' => 'Invalid event'
            ]);

            $parentId = $request->getParam('parent_id');
            $categoryId = $request->getParam('category_id');
            $pointId = $request->getParam('point_id');

            // Verify if parent event exists, if specified
            $parent = $parentId ? $this->mongo->findById('event', $parentId) : null;
            if ($parentId && null === $parent)
                $this->validator->addError('parent_id', 'Unknown event');

            // Verify if category exists
            if (!$categoryId || null === $this->mongo->findById('category', $categoryId))
                $this->validator->addError('category_id', 'Unknown category');

            // Verify if location exists
            if (!$pointId || null === $this->mongo->findById('point', $pointId)) {
                $this->validator->addError('point_id', 'Unknown location');
            }else{

            }


            if ($this->validator->isValid()) {
                $start = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('start_date') . ' ' . $request->getParam('start_time'));
                $end = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('end_date') . ' ' . $request->getParam('end_time'));

                $event = [
                    '_id' => $this->mongo->objectIdFactory(),
                    'name' => $request->getParam('name'),
                    'description' => $request->getParam('description'),
                    'begins_at' => $this->mongo->getUTCDateTime($start),
                    'ends_at' => $this->mongo->getUTCDateTime($end),
                    'parent_id' => $parentId,
                    'category_id' => $categoryId,
                    'location' => $this->mongo->getObjectId($pointId)
                ];

                $this->mongo->insert($event)->flush('event');

                $point = $this->mongo->findById('point',$pointId);

                $this->mongo->update(
                    [
                        '_id' => $this->mongo->getObjectId($pointId)],
                    [
                        'name' => $point->name,
                        'address' => $point->address,
                        'latitude' => $point->latitude,
                        'longitude' => $point->longitude,
                        'isEvent' => true,
                        'event_id' => $this->mongo->getObjectId($event['_id']),
                    ]
                )->flush('point');

                $this->flash('success', 'Event "' . $request->getParam('name') . '" added');
                return $this->redirect($response, 'get_events');
            }
        }

        return $this->view->render($response, 'Event/add.twig', [
            'events' => $this->mongo->findAll('event')->toArray(),
            'categories' => $this->mongo->findAll('category')->toArray(),
            'points' => $this->mongo->findAll('point')->toArray()
        ]);
    }

    public function edit(Request $request, Response $response, $id)
    {
        $event = $this->mongo->findById('event', $id);

        if (null === $event)
            throw $this->notFoundException($request, $response);

        if ($request->isPost()) {
            $this->validator->validate($request, [
                'name' => V::notBlank(),
                'description' => V::notBlank(),
                'start_time' => V::date('H:i'),
                'end_time' => V::date('H:i'),
                'start_date' => V::date('d/m/Y'),
                'end_date' => V::date('d/m/Y')
            ]);

            $this->validator->validate($request, [
                'parent_id' => V::optional(V::alnum())
            ], [
                'alnum' => 'Invalid event'
            ]);

            $this->validator->validate($request, [
                'category_id' => V::notBlank()->alnum()
            ], [
                'notBlank' => 'Please select a category',
                'alnum' => 'Invalid category'
            ]);

            $this->validator->validate($request, [
                'point_id' => V::notBlank()->alnum()
            ], [
                'notBlank' => 'Please select a location',
                'alnum' => 'Invalid event'
            ]);

            $parentId = $request->getParam('parent_id');
            $categoryId = $request->getParam('category_id');
            $pointId = $request->getParam('point_id');

            // Verify if parent event exists, if specified
            $parent = $parentId ? $this->mongo->findById('event', $parentId) : null;
            if ($parentId && null === $parent)
                $this->validator->addError('parent_id', 'Unknown event');

            // Verify if category exists
            if (!$categoryId || null === $this->mongo->findById('category', $categoryId))
                $this->validator->addError('category_id', 'Unknown category');

            // Verify if location exists
            if (!$pointId || null === $this->mongo->findById('point', $pointId))
                $this->validator->addError('point_id', 'Unknown location');

            if ($this->validator->isValid()) {
                $start = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('start_date') . ' ' . $request->getParam('start_time'));
                $end = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('end_date') . ' ' . $request->getParam('end_time'));

                $this->mongo->update(['_id' => $this->mongo->getObjectId($id)], [
                    'name' => $request->getParam('name'),
                    'description' => $request->getParam('description'),
                    'begins_at' => $this->mongo->getUTCDateTime($start),
                    'ends_at' => $this->mongo->getUTCDateTime($end),
                    'parent_id' => $parentId,
                    'category_id' => $categoryId,
                    'location' => $pointId
                ])->flush('event');

                $points = $this->mongo->where('point', ['event_id' => $this->mongo->getObjectId($id)]);

                foreach ($points as $point){
                    $this->mongo->update(['_id' => $this->mongo->getObjectId($point->_id)], [
                        'name' => $point->name,
                        'longitude' => $point->longitude,
                        'latitude' => $point->latitude,
                        'address' => $point->address,
                        'isEvent' => false,
                    ])->flush('point');


                }

                $point = $this->mongo->findById('point',$pointId);

                $this->mongo->update(
                    [
                        '_id' => $this->mongo->getObjectId($pointId)],
                    [
                        'name' => $point->name,
                        'address' => $point->address,
                        'latitude' => $point->latitude,
                        'longitude' => $point->longitude,
                        'isEvent' => true,
                        'event_id' => $this->mongo->getObjectId($id),
                    ]
                )->flush('point');

                $this->flash('success', 'Event "' . $request->getParam('name') . '" edited');
                return $this->redirect($response, 'get_events');
            }
        }

        // As long as we don't have a WHERE NOT or something like that...
        $events = [];
        foreach ($this->mongo->findAll('event') as $e){
            if ( ($e->_id != $id) && ($e->parent_id != $id) )
                array_push($events, $e);
        }

        return $this->view->render($response, 'Event/edit.twig', [
            'event' => $event,
            'events' => $events,
            'categories' => $this->mongo->findAll('category')->toArray(),
            'points' => $this->mongo->findAll('point')->toArray()
        ]);
    }

    public function delete(Request $request, Response $response, $id)
    {
        $event = $this->mongo->findById('event', $id);

        if (null === $event)
            throw $this->notFoundException($request, $response);

        $children = $this->mongo->where('event', ['parent_id' => $id]);

        foreach ($children as $child) {
            $this->mongo->delete(['_id' => $child->_id]);
        }

        $this->mongo->delete(['_id' => $this->mongo->getObjectId($id)])
                    ->flush('event');

        $points = $this->mongo->where('point', ['event_id' => $this->mongo->getObjectId($id)]);

        foreach ($points as $point){
            $this->mongo->update(['_id' => $this->mongo->getObjectId($point->_id)], [
                'name' => $point->name,
                'longitude' => $point->longitude,
                'latitude' => $point->latitude,
                'address' => $point->address,
                'isEvent' => false,
            ])->flush('point');
        }

        $this->flash('success', 'Event "' . $event->name . '" deleted');
        return $this->redirect($response, 'get_events');
    }
}
