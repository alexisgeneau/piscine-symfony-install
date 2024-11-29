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
    public function createArticle(EntityManagerInterface $entityManager, Request $request): Response {


        $message = "Veuillez remplir les champs";

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');
            $image = $request->request->get('image');

            $article = new Article();

            $article->setTitle($title);
            $article->setContent($content);
            $article->setImage($image);

            $article->setCreatedAt(new \DateTime());

            $entityManager->persist($article);
            $entityManager->flush();


            $message = "L'article '" . $article->getTitle() . "' a bien été créé";
        }

        return $this->render('article_create.html.twig', [
            'message' => $message
        ]);
    }


    #[Route('/article/delete/{id}', 'delete_article',  ['id' => '\d+'])]
    public function removeArticle(int $id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response {

        $article = $articleRepository->find($id);

        if (!$article) {
            return $this->redirectToRoute('not_found');
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->render('article_delete.html.twig', [
            'article' => $article
        ]);
    }

    #[Route('/article/update/{id}', 'update_article',  ['id' => '\d+'])]
    public function updateArticle(int $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        // je récupère mon article en BDD correspondant à l'id dans l'url
        // doctrine me renvoie une instance de l'entité Article
        // avec les valeurs des colonnes en propriété de mon instance
        $article = $articleRepository->find($id);

        // je modifie les valeurs des propriétés de l'instance (title, content...)
        $article->setTitle($article.getId() . 'test');
        $article->setContent('Contenu article 5 MAJ');

        // je re-enregistre l'article en BDD
        // vu que l'entité à déjà une propriété id avec une valeur
        // doctrine va mettre à jour l'enregistrement de l'article en BDD
        // et non créer un nouvel article
        $entityManager->persist($article);
        $entityManager->flush();

        return $this->render('article_update.html.twig', [
            'article' => $article
        ]);
    }

}
