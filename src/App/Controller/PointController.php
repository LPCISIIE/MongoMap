<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class PointController extends Controller
{
    public function add(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $this->validator->validate($request, [
                'name' => V::notBlank(),
                'address' => V::notBlank(),
                'latitude' => V::numeric(),
                'longitude' => V::numeric()
            ]);

            if ($this->validator->isValid()) {
                $this->mongo->insert([
                    'name' => $request->getParam('name'),
                    'address' => $request->getParam('address'),
                    'latitude' => $request->getParam('latitude'),
                    'longitude' => $request->getParam('longitude')
                ]);
                $this->mongo->flush('point');

                $this->mongo->insert([
                    'name' => $request->getParam('country'),
                ]);

                $this->mongo->flush('country');

                $country = $this->mongo->where('country', ['name' => $request->getParam('country')])->toArray();

               $this->mongo->insert([
                    'country_id' => $country[0]->_id,
                    'name' => $request->getParam('city'),
                ]);

                $this->mongo->flush('city');

                $this->flash('success', 'Point ' . $request->getParam('name') . ' added');
                return $this->redirect($response, 'home');
            }
        }

        return $this->view->render($response, 'Point/add.twig');
    }
}
