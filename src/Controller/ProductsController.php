<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController {

    /**
     * @Route("/products")
     */
    function productspage( ProductRepository $repo ) {

        $bikes = $repo->findBy([]);

        return $this->render('products.html.twig', ['bikes' => $bikes]);
    }


    /**
     * @Route("/product/{id}")
     */
    function productDetailsPage($id, ProductRepository $repo) {

        $bike = $repo->find($id);

        return $this->render('product_details.html.twig', ['bike' => $bike]);
    }
}