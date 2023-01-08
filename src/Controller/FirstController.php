<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first", name="app_first")
     */
    public function index(): Response
    {
        //die("je suis yosra");
        return $this->render('first/index.html.twig' , 
    ['name'=> 'Hassani' , 'firstname' => 'Yosra'] );
    }
}