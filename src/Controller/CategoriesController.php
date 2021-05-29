<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Products;

#[Route('/', name: 'category_', requirements: ['category' => 'b|ab|eb|m|g|a'])]
class CategoriesController extends AbstractController
{
    #[Route('/{category}', name: 'index')]
    public function index(Request $request): Response
    {
        $requestUri = $request->getPathInfo();
        $category = $this->getDoctrine()->getRepository(Categories::class)->findOneBy(['link' => $requestUri]);
        dump($category);
        $categoryId = $category->getId();
        
        $productsRepository = $this->getDoctrine()->getRepository(Products::class);

        //bestsellers
        $bestsellers = $productsRepository->getBestsellers($categoryId);
        
        //topdeals
        $topdeals = $productsRepository->getTopDeals($categoryId);

        //previews
        $previews = $productsRepository->getPreviews($categoryId);

        return $this->render('categories/index.html.twig', [
            'bestsellers'=>$bestsellers,
            'topdeals'=>$topdeals,
            'previews'=>$previews
        ]);
    }
}
