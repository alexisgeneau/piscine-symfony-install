<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokerController
{

    #[Route('/poker', 'poker')]
    public function poker()
    {
        $request = Request::createFromGlobals();
        $age = $request->query->get('age');

        if ($age >= 18) {
            return new Response('<p>Bienvenue sur le site de Poker en ligne</p>');
        } else {
            return new Response('Dégage morveux');
        }

    }

}