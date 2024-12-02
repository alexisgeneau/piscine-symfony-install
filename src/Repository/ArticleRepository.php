<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // fonction de recherche
    public function search(string $search)
    {
        return $this->createQueryBuilder('a')
            ->where('a.title LIKE :search')
            ->orWhere('a.content LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery()
            ->getResult();

        // SELECT * FROM article AS a WHERE a.title LIKE '%search%' OR WHERE a.content LIKE '%search%'
    }

}
