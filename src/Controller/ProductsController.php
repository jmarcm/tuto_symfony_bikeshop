<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductsController extends AbstractController {

    /**
     * @Route("/products")
     */
    function productspage(ProductRepository $repo) {

        $bikes = $repo->findBy([]);

        return $this->render('products.html.twig', ['bikes' => $bikes]);
    }


    /**
     * @Route("/product/{id}")
     */
    function productDetailsPage($id, Request $request, ProductRepository $repo, SessionInterface $session) {

        // rappel $bike est un objet avec des getters et des setters
        $bike = $repo->find($id);

        if (is_null($bike)) {
            throw $this->createNotFoundException('This product does not exists');
        }

        /** add to basket handling */
        // récupère la variable de session ou un empty array
        $basket = $session->get('basket', []);

        // si l'utilisateur a cliqué sur le bouton, il y a une méthode POST
        // autrement c'est une méthode GET
        if ($request->isMethod('POST')) {

            // rajoute le produit au panier
            $basket[$bike->getId()] = $bike;

            // actualise la variable de session
            $session->set('basket', $basket);
        }

        // actualise la valeur de inBasket pour ce produit
        // l'index est-il dans le panier
        $in_basket = array_key_exists($bike->getId(), $basket);

        return $this->render('product_details.html.twig', [
            'bike' => $bike,
            'inBasket' => $in_basket
        ]);
    }
}
