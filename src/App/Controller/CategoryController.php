<?php

namespace App\Controller;

use Respect\Validation\Validator as V;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CategoryController extends Controller
{
    public function get(Request $request, Response $response)
    {
        return $this->view->render($response, 'Admin/Category/get.twig', [
            'categories' => $this->mongo->findAll('category')
        ]);
    }

    public function add(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alnum()]);

            if ($this->validator->isValid()) {
                $this->mongo->insert(['name' => $request->getParam('name')]);
                $this->mongo->flush('category');

                $this->flash('success', 'Category "' . $request->getParam('name') . '" added');
                return $this->redirect($response, 'get_categories');
            }
        }

        return $this->view->render($response, 'Admin/Category/add.twig');
    }

    public function edit(Request $request, Response $response, $id)
    {
        $category = $this->mongo->findById('category', $id);

        if (null === $category)
            throw $this->notFoundException($request, $response);

        if ($request->isPost()) {
            $this->validator->validate($request, ['name' => V::notBlank()->alnum()]);

            if ($this->validator->isValid()) {
                $this->mongo->update([
                    '_id' => $this->mongo->getObjectId($id)
                ], [
                    'name' => $request->getParam('name')
                ]);
                $this->mongo->flush('category');

                $this->flash('success', 'Category "' . $request->getParam('name') . '" edited');
                return $this->redirect($response, 'get_categories');
            }
        }

        return $this->view->render($response, 'Admin/Category/edit.twig', [
            'category' => $category
        ]);
    }

    public function delete(Request $request, Response $response, $id)
    {
        $category = $this->mongo->findById('category', $id);

        if (null === $category)
            throw $this->notFoundException($request, $response);

        $this->mongo->delete(['_id' => $this->mongo->getObjectId($id)]);
        $this->mongo->flush('category');

        $this->flash('success', 'Category "' . $category->name . '" deleted');
        return $this->redirect($response, 'get_categories');
    }
}
