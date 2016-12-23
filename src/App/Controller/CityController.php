<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CityController extends Controller
{
    public function get(Request $request, Response $response)
    {
        $cities = $this->mongo->findAll('city')->toArray();

        $citiesWithCountry = [];
        foreach ($cities as $city) {
            $citiesWithCountry[] = [
                '_id' => $city->_id,
                'name' => $city->name,
                'country' => $this->mongo->findById('country', $city->country_id)
            ];
        }

        return $this->view->render($response, 'Admin/City/get.twig', [
            'cities' => $citiesWithCountry
        ]);
    }

    public function add(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alpha()]);
            $this->validator->validate($request, ['country_id' => V::notBlank()->alnum()], [
                'notBlank' => 'Please select a country',
                'alnum' => 'Invalid country'
            ]);

            $country = $request->getParam('country_id') ? $this->mongo->findById('country', $request->getParam('country_id')) : null;

            if (null === $country)
                $this->validator->addError('country_id', 'Unknown country');

            if ($this->validator->isValid()) {
                $this->mongo->insert([
                    'name' => $request->getParam('name'),
                    'country_id' => $country->_id
                ]);
                $this->mongo->flush('city');

                $this->flash('success', 'City "' . $request->getParam('name') . '" added');
                return $this->redirect($response, 'get_cities');
            }
        }

        return $this->view->render($response, 'Admin/City/add.twig', [
            'countries' => $this->mongo->findAll('country')
        ]);
    }

    public function edit(Request $request, Response $response, $id)
    {
        $city = $this->mongo->findById('city', $id);

        if (null === $city)
            throw $this->notFoundException($request, $response);

        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alpha()]);
            $this->validator->validate($request, ['country_id' => V::notBlank()->alnum()], [
                'notBlank' => 'Please select a country',
                'alnum' => 'Invalid country'
            ]);

            $country = $request->getParam('country_id') ? $this->mongo->findById('country', $request->getParam('country_id')) : null;

            if (null === $country)
                $this->validator->addError('country_id', 'Unknown country');

            if ($this->validator->isValid()) {
                $this->mongo->update(['_id' => $this->mongo->getObjectId($id)], [
                    'name' => $request->getParam('name'),
                    'country_id' => $country->_id
                ]);
                $this->mongo->flush('city');

                $this->flash('success', 'City "' . $request->getParam('name') . '" edited');
                return $this->redirect($response, 'get_cities');
            }
        }

        return $this->view->render($response, 'Admin/City/edit.twig', [
            'city' => $city,
            'countries' => $this->mongo->findAll('country')
        ]);
    }

    public function delete(Request $request, Response $response, $id)
    {
        $city = $this->mongo->findById('city', $id);

        if (null === $city)
            throw $this->notFoundException($request, $response);

        $this->mongo->delete(['_id' => $this->mongo->getObjectId($id)]);
        $this->mongo->flush('city');

        $this->flash('success', 'City "' . $city->name . '" deleted');
        return $this->redirect($response, 'get_cities');
    }
}
