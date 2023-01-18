<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    /**
     * @Route("/tab/{nb<\d+>?5}", name="app_tab")
     */
    public function index($nb): Response
    {
        $notes = [];
         for ($i=0 ; $i < $nb ; $i++ ){
            $notes[] = rand(0,20);
         }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    public function sayHello( $firstname,$name): Response
    {

        return $this->render('fragments/sayHello.html.twig',
        [
            'name'=> $name,
            'firstname' => $firstname
        ]);
    }

     /**
     * @Route("/tab/users", name="tab.users")
     */
    public function users(): Response
    {
        $users = [
            ['firstname' => 'Yosra' , 'name' => 'Hassani' , 'age' => 25],
            ['firstname' => 'Marwa' , 'name' => 'Hamila' , 'age' => 25],
            ['firstname' => 'syrin' , 'name' => 'Hassani' , 'age' => 22]
        ];
      
        return $this->render('tab/users.html.twig', [
            'users' => $users,
        ]);
    }
}
