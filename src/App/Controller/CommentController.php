<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CommentController extends Controller
{

    private function setCORS(Response $response){
        $response =  $response->withHeader(
            'Access-Control-Allow-Headers',
            'X-Requested-With, Content-Type, Accept, Origin, Authorization'
        );
        return $response->withHeader('Access-Control-Allow-Methods', 'DELETE,GET,POST,PUT');
    }

    public function API_get(Request $request, Response $response, $id)
    {
        $response = $this->setCORS($response);
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
                 'location_id' => $this->mongo->getObjectId($request->getParam('location')),
             ])->flush('comment');

             $this->flash('success', 'Comment added');
         }else{
             $this->flash('error', 'Something went wrong');
         }

         return $this->redirect($response, 'home');
    }

}