<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
   
    /**
     * @Route("/session", name="app_session")
     */
    public function index(Request $request): Response
    {
        //seesion_start()
        $session = $request->getSession();

        if($session->has('nbvisite')){
            $nbrvisit = $session->get('nbvisite') + 1;
        } else {
            $nbrvisit = 1;
        }
        $session->set('nbvisite' , $nbrvisit);
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }


    /**
     * @Route("/multi/{number1<\d+>}/{number2<\d+>}", name="multiplication" )
     */
    public function muliplication($number1 , $number2): Response
    {
        $res= $number1 * $number2;
        return new Response("<h1>$res</h1>");
    }
}
