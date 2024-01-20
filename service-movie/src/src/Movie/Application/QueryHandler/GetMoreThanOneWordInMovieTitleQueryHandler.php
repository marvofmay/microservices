<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use Doctrine\ORM\EntityManagerInterface;

class GetMoreThanOneWordInMovieTitleQueryHandler extends GetMoviesQueryHandler
{

    public function __construct(GetMoviesQuery $getMoviesQuery, EntityManagerInterface $entityManager)
    {
        parent::__construct($getMoviesQuery, $entityManager);
    }

    public function handle(): array
    {
        $this->makeQueryBuilder();
        $this->setFilters();

        $queryBuilder = $this->getQueryBuilder()
            ->andWhere('REGEXP(m.title, :regexp) = true')
            ->setParameter('regexp', '\s+');

        $totalMovies = $this->getTotalMovies();

        $this->setOrderBy();
        $this->setMaxResults();
        $this->setFirstResult();

        return [
            'totalMovies' => $totalMovies,
            'page' => $this->getPage(),
            'limit' => $this->getLimit(),
            'movies' => $this->getQueryBuilder()->getQuery()->getResult(),
        ];
    }
}
