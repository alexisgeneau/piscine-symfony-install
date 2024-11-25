<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    #[Route('/', 'home')]
    public function home() {
        return new Response('<h1>Page Accueil</h1>');
    }

}