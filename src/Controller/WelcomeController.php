<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController {

    /**
     * @Route("/welcome")
     */
    function welcomepage() {

        return $this->render('welcome.html.twig', ['date' => date('l')]);
    }
}