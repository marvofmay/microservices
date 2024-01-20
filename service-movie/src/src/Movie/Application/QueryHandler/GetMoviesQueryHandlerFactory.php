<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use Doctrine\ORM\EntityManagerInterface;

class GetMoviesQueryHandlerFactory
{
    public static function build(GetMoviesQuery $getMoviesQuery, EntityManagerInterface $entityManager): GetMoviesQueryHandler
    {
        switch ($getMoviesQuery->getAlgorithm()) {
            case 1:
                return new GetRandomThreeMoviesQueryHandler($getMoviesQuery, $entityManager);
            case 2:
                return new GetEvenNumberOfLettersInMovieTitleAndStartWithWQueryHandler($getMoviesQuery, $entityManager);
            case 3:
                return new GetMoreThanOneWordInMovieTitleQueryHandler($getMoviesQuery, $entityManager);
            default:
                return new GetMoviesQueryHandler($getMoviesQuery, $entityManager);
        }
    }
}
