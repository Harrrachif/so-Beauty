<?php

namespace App\Controller;

use App\Entity\Categories;

use App\Repository\ProduitsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="app_categories")
     */
    public function index(CategoriesRepository $categorieRepository): Response
    {

    //     return $this->render('categories/index.html.twig', [
    //         'controller_name' => 'CategoriesController',
    //     ]);
    // }
    return $this->render('categories/index.html.twig', [
        'categories' => $categorieRepository->findAll(),
    ]);
    }
    /**
     * @Route("/{id}", name="app_categories_show", methods={"GET"})
     */
    public function show(Categories $categories): Response
    {
        return $this->render('categories/show.html.twig', [
            'categories' => $categories,
        ]);
    }
}

