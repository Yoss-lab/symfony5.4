<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
  
class TodoController extends AbstractController
{
    


    /**
     * @Route("/todo", name="todo")
     */
    public function index(Request $request): Response
    {
         //seesion_start()
        $session = $request->getSession();

         //si je n'ai pas un tableau je l'initialise
        if(!$session->has('todos')){
            $todos = [
                'achat' => 'Acheter clé USB',
                'cours' => 'Finaliser mon cours',
                'correction' => 'Corriger mes examens',
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos viens d'etre initialisée");
        }
        //si j'ai un tableau je l'affiche
        return $this->render('todo/index.html.twig');
    }
   
    //Route générique
     /**
     * @Route("Route générique/{var}", name="var")
     */
    public function testOrderRoute($var): Response
    {
        return new Response("<html><body>$var</body></html>");
    }

    //sf5.4 est un valeur par défaut effectuée au content
     /**
     * @Route("/todo/add/{item}/{content?sf5.4}", name="add.todo")
     */
    public function addTodo(Request $request , $item , $content)
    {
         //seesion_start()
        $session = $request->getSession();

         //vérifier si j'ai mon tableau todos dans la session
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(isset($todos[$item])){
                $this->addFlash('error', "Le todo d'id $item existe déja dans la liste");
            }else{
                $this->addFlash('success', "Le todo $item ajoué avec succée");
                $todos[$item] = $content;
                $session->set('todos', $todos);
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisé");
        }
        //si j'ai un tableau je l'affiche
        return $this->redirectToRoute('todo');
    }
    
    /**
     * @Route("/delete/{item}", name="delete.todo")
     */
    public function deleteTodo(Request $request , $item)
    {
         //seesion_start()
        $session = $request->getSession();

         //vérifier si j'ai mon tableau todos dans la session
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(!isset($todos[$item])){
                $this->addFlash('error', "Le todo d'id $item n'existe pas dans la liste");
            }else{
                unset($todos[$item]);
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo $item supprimée avec succée");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisé");
        }
        //si j'ai un tableau je l'affiche
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/update/{item}/{content}", name="update.todo")
     */
    public function updateTodo(Request $request , $item , $content)
    {
         //seesion_start()
        $session = $request->getSession();

         //vérifier si j'ai mon tableau todos dans la session
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(!isset($todos[$item])){
                $this->addFlash('error', "Le todo d'id $item n'existe pas dans la liste");
            }else{
                $todos[$item] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo $item modifiée avec succée");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisé");
        }
        //si j'ai un tableau je l'affiche
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/reset", name="reset.todo")
     */
    public function resetTodo(Request $request)
    {
         //seesion_start()
        $session = $request->getSession();

        $session->remove('todos');
        //si j'ai un tableau je l'affiche
        return $this->redirectToRoute('todo');
    }
}
