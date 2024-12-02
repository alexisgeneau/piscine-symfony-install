<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/article/{id}/create', 'comment_create')]
    public function create(int $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, Request $request): Response
    {

        $articleFound = $articleRepository->find($id);

        if (!$articleFound) {
            return $this->redirectToRoute('not_found');
        }

        $comment = new Comment();
        $comment->setArticle($articleFound);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_show', ['id' => $comment->getArticle()->getId()]);
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
        $article = $articleRepository->find($id);

        $message = "Veuillez remplir les champs";

        if ($request->isMethod('POST')) {

            $title = $request->request->get('title');
            $content = $request->request->get('content');
            $image = $request->request->get('image');

            $article->setTitle($title);
            $article->setContent($content);
            $article->setImage($image);

            $entityManager->persist($article);
            $entityManager->flush();

            $message = "L'article '" . $article->getTitle() . "' a bien été mis à jour";
        }

        return $this->render('article_update.html.twig', [
            'article' => $article,
            'message' => $message
        ]);
    }

}
