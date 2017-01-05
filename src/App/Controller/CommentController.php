<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CommentController extends Controller
{

    public function API_get(Request $request, Response $response, Array $arg)
    {
        return json_encode($this->mongo->findById('Comment', $arg['id']));
    }

    public function add(Request $request, Response $response)
    {
         $this->validator->validate($request, [
             'comment' => V::notBlank(),
             'author' => V::notBlank()
         ]);

         if ($this->validator->isValid()) {
             $this->mongo->insert([
                 'comment' => $request->getParam('comment'),
                 'author' => $request->getParam('author')
             ])->flush('comment');

             $this->flash('success', 'Comment added');
         }else{
             $this->flash('danger', 'Something went wrong');
         }
         return $this->redirect($response, 'home');
    }

}