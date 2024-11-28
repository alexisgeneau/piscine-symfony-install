<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', 'articles_list')]
    public function articles(ArticleRepository $articleRepository): Response
    {
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


    #[Route('/article/create', 'create_article')]
    public function createArticle(EntityManagerInterface $entityManager): Response {

        // je créé une instance de l'entité Article
        // car c'est elle qui représente les articles dans mon application
        $article = new Article();
        // j'utilise les méthodes set pour remplir
        // les propriétés de mon article
        $article->setTitle('Article 5');
        $article->setContent('Contenu article 5');
        $article->setImage("https://cdn.futura-sciences.com/sources/images/AI-creation.jpg");
        $article->setCreatedAt(new \DateTime());

        // à ce moment, la variable $article
        // contient une instance de la classe Article avec
        // les données voulues(sauf l'id car il sera généré par la BDD)

        // j'utilise l'instance de la classe
        // EntityManager. C'est cette classe qui me permet de sauver / supprimer
        // des entités en BDD
        // L'entity manager et Doctrine savent que l'entité correspond à la table article
        // et que la propriété title correspond à la colonne title grâce aux annotations
        // donc L'entity manager sait comment faire correspondre mon instance d'entité à un
        // enregistrement dans la table
        $entityManager->persist($article);

        // persist permet de pre-sauvegarder mes entités
        // flush execute la requête SQL dans ma BDD
        // pour créer un enregistrement d'article dans la table
        $entityManager->flush();


        return new Response('OK');
    }

}
