<?php

namespace App\Controller;

use Respect\Validation\Validator as V;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EventController extends Controller
{
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

            $parentId = $request->getParam('parent_id');
            $event = $parentId ? $this->mongo->findById('event', $parentId) : null;

            if ($parentId && null === $event)
                $this->validator->addError('parent_id', 'Unknown event');

            if ($this->validator->isValid()) {
                $start = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('start_date') . ' ' . $request->getParam('start_time'));
                $end = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('end_date') . ' ' . $request->getParam('end_time'));

                $this->mongo->insert([
                    'name' => $request->getParam('name'),
                    'description' => $request->getParam('description'),
                    'begins_at' => $this->mongo->getUTCDateTime($start),
                    'ends_at' => $this->mongo->getUTCDateTime($end),
                    'parent_id' => $parentId
                ]);
                $this->mongo->flush('event');

                $this->flash('success', 'Event "' . $request->getParam('name') . '" added');
                return $this->redirect($response, 'get_events');
            }
        }

        return $this->view->render($response, 'Event/add.twig', [
            'events' => $this->mongo->findAll('event')
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

            $parentId = $request->getParam('parent_id');
            $event = $parentId ? $this->mongo->findById('event', $parentId) : null;

            if ($parentId && null === $event)
                $this->validator->addError('parent_id', 'Unknown event');

            if ($this->validator->isValid()) {
                $start = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('start_date') . ' ' . $request->getParam('start_time'));
                $end = \DateTime::createFromFormat('d/m/Y H:i', $request->getParam('end_date') . ' ' . $request->getParam('end_time'));

                $this->mongo->update(['_id' => $this->mongo->getObjectId($id)], [
                    'name' => $request->getParam('name'),
                    'description' => $request->getParam('description'),
                    'begins_at' => $this->mongo->getUTCDateTime($start),
                    'ends_at' => $this->mongo->getUTCDateTime($end),
                    'parent_id' => $parentId
                ]);
                $this->mongo->flush('event');

                $this->flash('success', 'Event "' . $request->getParam('name') . '" edited');
                return $this->redirect($response, 'get_events');
            }
        }

        return $this->view->render($response, 'Event/edit.twig', [
            'event' => $event,
            'events' => $this->mongo->findAll('event')
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

        $this->mongo->delete(['_id' => $this->mongo->getObjectId($id)]);
        $this->mongo->flush('event');

        $this->flash('success', 'Event "' . $event->name . '" deleted');
        return $this->redirect($response, 'get_events');
    }
}
