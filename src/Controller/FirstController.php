<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController {


    /**
     * @Route("/homepage")
     */
    function homepage() {

        return new Response('<html><body><h1>Salut</h1></html>');

    }

}