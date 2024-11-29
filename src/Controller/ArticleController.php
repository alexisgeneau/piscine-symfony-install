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
    public function updateArticle(int $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, Request $request)
    {
        // je récupère en BDD l'article lié à l'id de l'url
        // Doctrine (ORM) me créé une instance de l'entité Article
        // et la remplie avec les données de l'article en BDD
        $article = $articleRepository->find($id);

        $message = "Veuillez remplir les champs";


        // si c'est une requête POST
        if ($request->isMethod('POST')) {

            // je récupère la valeur des champs
            // s'ils ont pas été modifié, je récupère la même
            // valeur que celle de la BDD (car les champs sont pré-remplis
            // avec la valeur de BDD)
            $title = $request->request->get('title');
            $content = $request->request->get('content');
            $image = $request->request->get('image');

            // je modifie les valeurs de mon entité avec celles des champs
            $article->setTitle($title);
            $article->setContent($content);
            $article->setImage($image);

            // je mets à jour l'article en BDD
            $entityManager->persist($article);
            $entityManager->flush();

            $message = "L'article '" . $article->getTitle() . "' a bien été mis à jour";
        }

        // j'envoie au formulaire twig
        // l'article existant en BDD
        // pour pre-remplir les champs
        return $this->render('article_update.html.twig', [
            'article' => $article,
            'message' => $message
        ]);
    }

}
