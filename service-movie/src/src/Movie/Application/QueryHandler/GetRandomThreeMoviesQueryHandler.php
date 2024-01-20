<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use Doctrine\ORM\EntityManagerInterface;

class GetRandomThreeMoviesQueryHandler extends GetMoviesQueryHandler
{
    public function __construct(GetMoviesQuery $getMoviesQuery, EntityManagerInterface $entityManager)
    {
        parent::__construct($getMoviesQuery, $entityManager);
    }

    public function handle(): array
    {
        $this->makeQueryBuilder();

        $queryBuilder = $this->getQueryBuilder()
            ->orderBy('RAND()')
            ->setMaxResults(3);

        $movies = $queryBuilder->getQuery()->getResult();

        return [
            'totalMovies' => count($movies),
            'page' => $this->getPage(),
            'limit' => $this->getLimit(),
            'movies' => $movies,
        ];
    }
}
