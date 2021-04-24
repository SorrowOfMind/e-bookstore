<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;
use App\Entity\Banners;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        //fetch categories + subcategories
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
       
        $subcategoriesNames = [];    

        foreach($categories as $category){
            $subcategories = $category->getSubcategories();
            foreach($subcategories as $subcategory){
                $subcategoriesNames[$category->getName()][] = $subcategory->getName();
            }
        }
        dump($subcategoriesNames);

        //fetch banners;
        $banners = $this->getDoctrine()->getRepository(Banners::class)->findBy(['role' => 'main']);

        return $this->render('home/index.html.twig', 
                            [
                                'categories' => $categories, 
                                'subcategories' => $subcategoriesNames,
                                'banners'=> $banners
                            ]);
    }
}
