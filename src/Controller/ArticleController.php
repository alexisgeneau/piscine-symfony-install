<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    #[Route('/articles', 'articles_list')]
    public function articles()
    {

		$articles = [
			[
				'id' => 1,
				'title' => 'Article 1',
				'content' => 'Content of article 1',
				'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'color' => 'blue',
			],
			[
				'id' => 2,
				'title' => 'Article 2',
				'content' => 'Content of article 2',
				'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'color' => 'yellow',
			],
			[
				'id' => 3,
				'title' => 'Article 3',
				'content' => 'Content of article 3',
				'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
			],
			[
				'id' => 4,
				'title' => 'Article 4',
				'content' => 'Content of article 4',
				'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
			],
			[
				'id' => 5,
				'title' => 'Article 5',
				'content' => 'Content of article 5',
				'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
			]
	
        ];


        return $this->render('articles_list.html.twig', [
            'articles' => $articles
        ]);

    }

    #[Route('/article/{id}', 'article_show')]
    public function showArticle($id)
    {

        $articles = [
            [
                'id' => 1,
                'title' => 'Article 1',
                'content' => 'Content of article 1',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'createdAt' => new \DateTime('2030-01-01 00:00:00')
            ],
            [
                'id' => 2,
                'title' => 'Article 2',
                'content' => 'Content of article 2',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'createdAt' => new \DateTime('2030-01-01 00:00:00')
            ],
            [
                'id' => 3,
                'title' => 'Article 3',
                'content' => 'Content of article 3',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'createdAt' => new \DateTime('2030-01-01 00:00:00')
            ],
            [
                'id' => 4,
                'title' => 'Article 4',
                'content' => 'Content of article 4',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'createdAt' => new \DateTime('2030-01-01 00:00:00')
            ],
            [
                'id' => 5,
                'title' => 'Article 5',
                'content' => 'Content of article 5',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
                'createdAt' => new \DateTime('2030-01-01 00:00:00')
            ]

        ];

        $articleFound = null;

        foreach ($articles as $article) {
            if ($article['id'] === (int) $id) {
                $articleFound = $article;
            }
        }

        return $this->render('article_show.html.twig', [
          'article' => $articleFound
        ]);

    }


    #[Route('/articles/search-results', 'article_search_results')]
    // plutôt d'instancier la classe Request manuellement
    // je peux utiliser le système d'instanciation automatiquement
    // de symfony
    // pour ça, je lui passe en parametre de méthode
    // le type de la classe voulue, suivie d'une variable
    // dans laquelle je veux que symfony stocke l'instance de la classe
    // ce mécanisme est appelé autowire
    public function articleSearchResults(Request $request) {

        $search = $request->query->get('search');

        return $this->render('article_search_results.html.twig', [
            'search' => $search
        ]);

    }

}
