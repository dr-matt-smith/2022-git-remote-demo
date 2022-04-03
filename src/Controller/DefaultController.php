<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default')]
    public function index(ProductRepository $productRepository): Response
    {
        $template = 'default/index.html.twig';
        $argsArray = ['products' => $productRepository->findAll()];

        return $this->render($template, $argsArray);
    }


    #[Route('/aboutus', name: 'aboutus')]
    public function aboutus(): Response
    {
        $template = 'about/index.html.twig';
        $argsArray = [];
        return $this->render($template, $argsArray);
    }

}
