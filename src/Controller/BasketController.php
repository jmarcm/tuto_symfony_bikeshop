<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController {

    /**
     * @Route("/basket")
     */
    public function basket(Request $request, SessionInterface $session): Response {

        $basket = $session->get('basket', []);

        /** suppression d'un article via son id transmis par POST */
        if ($request->isMethod('POST')) {

            $bike_id = $request->request->get('id');
            unset($basket[$bike_id]);

            $session->set('basket', $basket);
        }

        /** calcul du total */
        // via un array des prix
        $total = array_sum(array_map(function ($product) {
            return $product->getPrice();
        }, $basket));

        return $this->render('basket.html.twig', [
            'basket' => $basket,
            'total' => $total
        ]);
    }
}
