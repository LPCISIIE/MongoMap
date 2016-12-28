<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AdminController extends Controller
{
    public function home(Request $request, Response $response)
    {
        return $this->view->render($response, 'Admin/home.twig');
    }
}
