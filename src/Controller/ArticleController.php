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
        $article = new Article();

        $article->setTitle('Article 5');
        $article->setContent('Contenu article 5');
        $article->setImage("https://cdn.futura-sciences.com/sources/images/AI-creation.jpg");
        $article->setCreatedAt(new \DateTime());

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('OK');
    }


    #[Route('/article/delete/{id}', 'delete_article',  ['id' => '\d+'])]
    public function removeArticle(int $id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response {

        // je récupère l'article que je veux supprimer
        // le repository fait la requête SQL et reconstruit une instance de la classe Article
        // je dois récupérer une instance de classe car pour la suppression Doctrine a besoin d'une instance de classe
        $article = $articleRepository->find($id);

        if (!$article) {
            return $this->redirectToRoute('not_found');
        }

        // j'utilise la méthode remove de l'entity manager pour supprimer l'article
        $entityManager->remove($article);
        $entityManager->flush();

        return new Response('suppr');
    }

}
