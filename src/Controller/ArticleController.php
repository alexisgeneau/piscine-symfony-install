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


    // je défini une url avec une variable id
    // ça veut dire que le router matchera toutes les urls
    // qui ont cette forme "/article/quelqueChose", "/article/23", "article/toto"
    #[Route('/article/{id}', 'article_show')]
    // je passe en parametre de la méthode une variable qui a le même nom
    // que la variable de l'url. Et symfony s'occupe du reste : il récupère la valeur
    // de la variable dans l'url et la stocke dans ma variable $id
    public function showArticle($id)
    {

        $articles = [
            [
                'id' => 1,
                'title' => 'Article 1',
                'content' => 'Content of article 1',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
            ],
            [
                'id' => 2,
                'title' => 'Article 2',
                'content' => 'Content of article 2',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/012/176/986/small_2x/a-3d-rendering-image-of-grassed-hill-nature-scenery-png.png',
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

}
