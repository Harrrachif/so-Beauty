<?php

namespace App\Controller;

use App\Form\FormContactType;
use App\Controller\FormController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="app_form")
     */
    public function index(Request $request): Response
    {

        // recuperer le formulaire dans une variable correspondant 
        // a FormContactType
        $form = $this->createForm(FormContactType::class);

        // on prend l'objet form qui va lire la request
        $form->handleRequest($request);

        // test si l'envoie post est valide et bien envoyé
        if ($form->isSubmitted() && $form->isvalid()) {
            // creer une variable task qui est un tableau clé valeur
            // contenant les données envoyé en POST
    
                $task = $form->getData();

        // renvoie une twig contenant les données du form
        // avec la variable task

        return $this->renderForm('form/traitement.html.twig', [
            'mon_formulaire'=>$task
        ]);
            dd($task);

        }

        return $this->renderForm('form/index.html.twig', [
           'monformulaire'=>$form
        ]);
    }
}
