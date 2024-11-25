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

        $message = "";

        if ($age >= 18) {
            $message = "Tu peux accéder à la table de Poker";
        } else {
            $message = "Tu peux partir";
        }

        return $this->render('poker.html.twig', [
            'message' => $message
        ]);

    }

}