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


    #[Route('/article', 'article_show')]
    public function showArticle()
    {
        // j'utilise une instance de la classe Request
        // de Symfony, créée avec la méthode statique "createFromGlobals"
        // cette classe me permet de récupérer n'importe quelle donnée
        // de la requête HTTP
        $request = Request::createFromGlobals();
        // je récupère la donnée GET "id"
        $id = $request->query->get('id');

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


        // je créé une variable pour contenir mon article trouvé
        // pour l'instant à null
        $articleFound = null;

        // pour chaque article de la liste
        // je check si son id correspond à l'id récupéré dans l'url
        // si c'est le cas, je le stocke dans ma variable
        foreach ($articles as $article) {
            if ($article['id'] === (int) $id) {
                $articleFound = $article;
            }
        }


        // je créé une réponse HTTP contenant le HTML
        // issu de mon fichier twig
        // pour ça j'utilise la méthode render de l'abstract controller
        // qui prend en premier parametre le fichier twig (dans le dossier templates)
        // et en deuxième un tableau contenant
        // les variables utilisables dans twig
        return $this->render('article_show.html.twig', [
          'article' => $articleFound
        ]);

    }

}
