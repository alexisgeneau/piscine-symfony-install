<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    #[Route('/articles', 'articles_list')]
    // la classe ArticleRepository est générée automatiquement
    // lors de la génération de l'entité Article
    // Elle contient plusieurs méthodes pour faire des requête de type SELECT
    // sur la table article
    // j'utilise l'autowire pour instancier cette classe
    public function articles(ArticleRepository $articleRepository): Response
    {
        // j'utilise la méthode findAll du repository
        // pour récupérer tous les articles de la table article
        $articles = $articleRepository->findAll();

        return $this->render('articles_list.html.twig', [
            'articles' => $articles
        ]);

    }

    #[Route('/article/{id}', 'article_show', ['id' => '\d+'])]
    public function showArticle(int $id, ArticleRepository $articleRepository): Response
    {
        $articleFound = $articleRepository->find($id);

        if (!$articleFound) {
            return $this->redirectToRoute('not_found');
        }



        return $this->render('article_show.html.twig', [
          'article' => $articleFound
        ]);

    }


    #[Route('/articles/search-results', 'article_search_results')]
    public function articleSearchResults(Request $request): Response {
        $search = $request->query->get('search');


        return $this->render('article_search_results.html.twig', [
            'search' => $search
        ]);

    }

}
