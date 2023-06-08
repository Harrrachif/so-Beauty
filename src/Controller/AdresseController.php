<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdresseController extends AbstractController
{
    private $entityManager; // On enregistre l'adresse en base de données et pour cela on aura besoin de l'entityManageur de dotrine (base de données) et la fonction __construct.

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
 


    /**
     * @Route("/adresse", name="app_adresse")
     */
    public function index(): Response
    {
        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
        ]);
    }
     /**
     * @Route("/ajouter-une-adresse", name="app_adresse_add")
     */
    // #[Route('/ajouter-une-adresse', name: 'app_adresse_add')]
   public function add(Request $request): Response
   {
    $adress = new Adresse();//On lui créer l'instance de la class Adresse

       $form = $this->createForm(AdresseType::class, $adress);

       // On faire la sousmission du formulaire en utilisant le handleRequest
       $form->handleRequest($request); // puis mettre la requête en injection 

       if ($form->isSubmitted() && $form->isValid()) {
           $adress->setUtilisateur($this->getUser()); // cette fonction permet de lier l'utilisateur à son adresse, l'utilisateur étant dans l'entité User
           $this->entityManager->persist($adress);// Tu me figes la donnée pour qu'elle soit insérée dans mon objet Address.
           $this->entityManager->flush();

              
       }

       return $this->render('adresse/adresse_form.html.twig', [// On passe dans le tableau twig mes variable 'form' et $form->createView()
           'formulaire' => $form->createView()
       ]);
   }
    /**
     * @Route("/modifier-une-adresse/{id}", name="app_adresse_edit")
     */

//    #[Route('/modifier-une-adresse/{id}', name: 'app_adresse_edit')]
   public function edit(Request $request, $id): Response
   {
       //On va aller chercher l'adresse que l'on souhaite modifier
       $adress = $this->entityManager->getRepository(Adresse::class)->findOneById($id);

       if (!$adress || $adress->getUtilisateur() !=$this->getUser()) {
           // Si mon adresse n'existe pas, tu fais une redirection
           return $this->redirectToRoute('app_accueil');
       // Et est-ce que l'adresse que tu as récupéré appartient bien à l'utilisateur ?
       }

       $form = $this->createForm(AdresseType::class, $adress);


       // On faire la sousmission du formulaire en utilisant le handleRequest
       $form->handleRequest($request); // puis mettre la requête en injection 

       if ($form->isSubmitted() && $form->isValid()) {
           $this->entityManager->flush();
           return $this->redirectToRoute('app_accueil');// Lorsque l'adresse a été ajouter, on demande que la page soir rediriger vers le compte address
           // Pour l'affichage, il faut retourner dans le fichier address.html.twig
       }

       return $this->render('adresse/adresse_form.html.twig', [// On passe dans le tableau twig mes variable 'form' et $form->createView()
           'formulaire' => $form->createView()
       ]);
   }
    /**
     * @Route("/suprimer-une-adresse/{id}", name="app_adresse_delete")
     */

//    #[Route('/supprimer-une-adresse/{id}', name: 'app_adresse_delete')]
   public function delete($id): Response
   {
       //On va aller chercher l'adresse que l'on souhaite supprimer
       $adress = $this->entityManager->getRepository(Adresse::class)->findOneById($id);

       // Si l'adresse existe et que c'est celle de l'utilisateur
       if ($adress && $adress->getUtilisateur() == $this->getUser()) {
           $this->entityManager->remove($adress);// on supprime
           $this->entityManager->flush();

       }

       return $this->redirectToRoute('app_adresse');
}


}
