<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CountryController extends Controller
{
    public function get(Request $request, Response $response)
    {
        return $this->view->render($response, 'Admin/Country/get.twig', [
            'countries' => $this->mongo->findAll('country')
        ]);
    }

    public function add(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alnum()]);

            if ($this->validator->isValid()) {
                $this->mongo->insert(['name' => $request->getParam('name')]);
                $this->mongo->flush('country');

                $this->flash('success', 'Country "' . $request->getParam('name') . '" added');
                return $this->redirect($response, 'get_countries');
            }
        }

        return $this->view->render($response, 'Admin/Country/add.twig');
    }

    public function edit(Request $request, Response $response, $id)
    {
        $country = $this->mongo->findById('country', $id);

        if (null === $country)
            throw $this->notFoundException($request, $response);

        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alnum()]);

            if ($this->validator->isValid()) {
                $this->mongo->update(['_id' => $this->mongo->getObjectId($id)], ['name' => $request->getParam('name')]);
                $this->mongo->flush('country');

                $this->flash('success', 'Country "' . $request->getParam('name') . '" edited');
                return $this->redirect($response, 'get_countries');
            }
        }

        return $this->view->render($response, 'Admin/Country/edit.twig', [
            'country' => $country
        ]);
    }

    public function delete(Request $request, Response $response, $id)
    {
        $country = $this->mongo->findById('country', $id);

        if (null === $country)
            throw $this->notFoundException($request, $response);

        $this->mongo->delete(['_id' => $this->mongo->getObjectId($id)]);
        $this->mongo->flush('country');

        $this->flash('success', 'Country "' . $country->name . '" deleted');
        return $this->redirect($response, 'get_countries');
    }
}
