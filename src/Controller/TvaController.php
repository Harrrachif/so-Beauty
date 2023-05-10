<?php

namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TvaController extends AbstractController
{
    /**
     * @Route("/tva", name="app_tva")
     */
    public function index(Request $request, TvaService $tvaService): Response
    {
        $form=$this->createForm(TvaType::class);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data= $form->getData();
            
            $data['tva']=$data['prix']*0.2;

            $data['tva']=$TvaService->calcul($data['prix']);

            return $this->render('form/traitement.html.twig',[
                'mes_donnes'=>$data
            ]);
        }


        return $this->renderForm('tva/index.html.twig', [
           'le_form_tva'=>$form
        ]);
    }
}
