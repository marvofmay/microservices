<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use Doctrine\ORM\EntityManagerInterface;

class GetMoviesQueryHandlerFactory
{
    public static function build(GetMoviesQuery $getMoviesQuery, EntityManagerInterface $entityManager): GetMoviesQueryHandler
    {
        return match ($getMoviesQuery->getAlgorithm()) {
            1 => new GetRandomThreeMoviesQueryHandler($getMoviesQuery, $entityManager),
            2 => new GetEvenNumberOfLettersInMovieTitleAndStartWithWQueryHandler($getMoviesQuery, $entityManager),
            3 => new GetMoreThanOneWordInMovieTitleQueryHandler($getMoviesQuery, $entityManager),
            default => new GetMoviesQueryHandler($getMoviesQuery, $entityManager)
        };
    }
}
