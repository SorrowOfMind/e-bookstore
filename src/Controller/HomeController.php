<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Subcategories;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        // $sub = $categories->getSubcategories();
        // foreach ($sub as $s){
        //     dump($s->getName());
        // }
        $subcategoriesNames = [];    
        foreach($categories as $category){
            $subcategories = $category->getSubcategories();
            foreach($subcategories as $subcategory){
                $subcategoriesNames[$category->getName()][] = $subcategory->getName();
            }
        }
        dump($subcategoriesNames);

        return $this->render('home/index.html.twig', ['categories' => $categories, 'subcategories' => $subcategoriesNames]);
    }
}
