<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AppController extends Controller
{
    public function home(Request $request, Response $response)
    {
        // We thought about you Mr Nourissier ;-)
        $time1 = new \DateTime();
        $points =  $this->mongo->findAll('point');
        $time2 = new \DateTime();

        // Depending the PHP Version
        $diff = $time1->getTimestamp() - $time2->getTimestamp();
        if ($diff == 0)
            $diff = $time1->diff($time2)->f;

        return $this->view->render($response, 'App/home.twig', [
            'points' => $points->toArray(),
            'time' =>  $diff
        ]);
    }
}
