<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', 'home')]
    public function home() {
        // la méthode render de la classe AbstractController
        // récupère le fichier twig passé en parametre
        // dans le dossier template
        // elle le convertit en HTML
        // elle créé une réponse HTTP valide
        // avec en status HTTP 200
        // et en body, le HTML généré
        return $this->render('home.html.twig');
    }

}