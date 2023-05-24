<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitscategoriesController extends AbstractController
{
    /**
     * @Route("/produitscategories", name="app_produitscategories")
     */
    public function index(Categories $categories, ProduitsRepository $produitsRepository): Response
    {
        $produits_cat=$produitsRepository->findBy([
            'categories'=>$categorie
        ]);
        // dd($categorie);
        // dd($aproduitRepository->findAll());
        // return $this->render('aproduitcategorie/index.html.twig', [
        //     'produit_cat' => $produit_cat,
        // ]);
    

        return $this->render('produitscategories/index.html.twig', [
            'controller_name' => 'ProduitscategoriesController',
            'produits_cat' => $produits_cat,
        ]);
    }
    }
