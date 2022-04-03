<?php

namespace App\Controller;

use App\Entity\Product;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/basket', name: 'basket')]
    public function index(): Response
    {   $session = $this->requestStack->getSession();
        $template = 'basket/basket.html.twig';
        $args = [$session];
        return $this->render($template,$args);
    }

    #[Route('/basket/{id}', name: 'addtobasket')]
    public function addItem(Product $product, LoggerInterface $logger): Response
    {
        $products = [];

        $session = $this->requestStack->getSession();
        if ($session->has('basket')) {
            $products = $session->get('basket');
        }

        // get ID of product
        $id = $product->getId();

        // only try to add to array if not already in the array
        if (!array_key_exists($id, $products)) {
            // append $product to our list
            $products[$id] = $product;

            // store updated array back into the session
            $session->set('basket', $products);
        }
        $logger->info('Basket', [
            'basket' => $products
        ]);

        return $this->redirectToRoute('basket');
    }

    #[Route('/basket/delete/{id}', name: 'delete')]
    public function delete(int $id): Response
    {
        // default - new empty array
        $products = [];
        // if 'products' array in session, retrieve and store in $products
        $session = $this->requestStack->getSession();
        if ($session->has('basket')) {
            $products = $session->get('basket');
        }
        // only try to remove if it's in the array
        if (array_key_exists($id, $products)) {
            unset($products[$id]);
            if (sizeof($products) < 1) {
                return $this->redirectToRoute('basket_clear');
            }
            // store updated array back into the session
            $session->set('basket', $products);
        }
        return $this->redirectToRoute('basket');


    }

    #[Route('/basket/clear', name: 'basket_clear')]
    public function clear(): Response
    {
        $products = [];
        // if 'products' array in session, retrieve and store in $products
        $session = $this->requestStack->getSession();
        $session->clear();

        return $this->redirectToRoute('basket');
    }
}
