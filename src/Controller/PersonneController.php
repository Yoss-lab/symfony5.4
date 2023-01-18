<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
/**
     * @Route("/personne")
     */
class PersonneController extends AbstractController
{

    /**
     * @Route("/all", name="personne.all")
     */
    public function allPersonne(): Response
    {
    
        $repository = $this->getDoctrine()->getManager()->getRepository(Personne::class);
        $personnes = $repository->findAll();
        return $this->render('personne/allPersonne.html.twig', [
            'personnes' => $personnes,
        ]);

    }

     /**
     * @Route("/condition", name="personne.condition")
     */
    public function condPersonne(): Response
    {
    
        $repository = $this->getDoctrine()->getManager()->getRepository(Personne::class);
        $personnes = $repository->findBy(['firstname'=>'Colette'], ['age'=>'DESC'] ,2 );
        return $this->render('personne/allPersonne.html.twig', [
            'personnes' => $personnes,
        ]);

    }

     /**
     * @Route("/pagination/{page?1}/{nbr?3}", name="pagination")
     */
    public function paginationPersonne($page,$nbr): Response
    {
    
        $repository = $this->getDoctrine()->getManager()->getRepository(Personne::class);
        $personnes = $repository->findBy([], [] ,$nbr, ($page - 1)* $nbr );
        return $this->render('personne/paginationPersonne.html.twig', [
            'personnes' => $personnes,
        ]);

    }

    /**
     * @Route("/details/{id<\d+>}", name="personne.details")
     */
    /* public function detailsPersonne($id): Response */
    public function detailsPersonne(Personne $personne = null): Response
    {
    
       /*  $repository = $this->getDoctrine()->getManager()->getRepository(Personne::class);
        $personne = $repository->find($id); */
        if(!$personne){
            $this->addFlash('error' , "La personne n'existe pas!");
            return $this->redirectToRoute('personne.all');
        }
        return $this->render('personne/detailsPersonne.html.twig', [
            'personne' => $personne,
        ]);

    }


    /**
     * @Route("/add", name="personne.add")
     */
    public function addPersonne(): Response
    {
        //$entityManager = $doctrine->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        $personne = new Personne();
        $personne->setFirstname('Yosra');
        $personne->setName('Hassani');
        $personne->setAge(25);

          // tell Doctrine you want to (eventually) save the Product (no queries yet)
          //ajouter l'opération d'insertion de la personne dans ma transaction
          $entityManager->persist($personne);

          // actually executes the queries (i.e. the INSERT query)
          //execute la transaction
          $entityManager->flush();

        return $this->render('personne/details.html.twig', [
            'personne' => $personne,
        ]);
    }
}
