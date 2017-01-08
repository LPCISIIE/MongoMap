<?php

namespace App\Controller;

use MongoDB\BSON\Timestamp;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AppController extends Controller
{
    public function home(Request $request, Response $response)
    {
        /**
         *  We thought about you Mr Nourissier ;-)
         */
        $time1 = new \DateTime();
        $query =  $this->mongo->findAll('point')->toArray();
        $time2 = new \DateTime();
        $difference = $time1->diff($time2);
        $milliseconds = round ( $difference->f , 15 ); ;



        return $this->view->render($response, 'App/home.twig', [
            'points' => $query,
            'time' =>  $milliseconds,
        ]);
    }
}
