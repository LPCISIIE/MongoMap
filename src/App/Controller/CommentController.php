<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as V;

class CommentController
{

    public function API_get()
    {
        return json_encode($this->mongo->findById('Comment', $id));
    }

}