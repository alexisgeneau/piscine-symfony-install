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

        // appelle la méthode createFromGlobals
        // sans avoir besoin de faire l'instance
        // de classe manuellement
        // cette méthode permet de remplir
        // la variable $request avec toutes
        // les données de requête (GET, POST, SESSION, addresse IP etc)
        $request = Request::createFromGlobals();
        // j'utilise la propriété query, qui me
        // permet de récupérer les données GET
        $age = $request->query->get('age');


        var_dump($age); die;



        return new Response('Bienvenue sur le site de Poker en ligne');
    }

}