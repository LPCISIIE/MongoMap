<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CommentController extends Controller
{


    public function API_get(Request $request, Response $response, $id)
    {
        return json_encode($this->mongo->where('comment', ['location_id' => $id])->toArray());
    }

    public function add(Request $request, Response $response)
    {
         $this->validator->validate($request, [
             'comment' => V::notBlank(),
             'author' => V::notBlank(),
             'location' => V::notBlank(),
         ]);

         if ($this->validator->isValid()) {
             $this->mongo->insert([
                 'comment' => $request->getParam('comment'),
                 'author' => $request->getParam('author'),
                 'location_id' => $request->getParam('location')
             ])->flush('comment');

             $this->flash('success', 'Comment added');
         }else{
             $this->flash('danger', 'Something went wrong');
         }

         return $this->redirect($response, 'home');
    }

}