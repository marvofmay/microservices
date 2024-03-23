<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Domain\Entity\Category;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Domain\Service\WriterService\MovieWriterService;

class CreateMovieCommandHandler
{
    public function __construct(private readonly MovieWriterService $movieWriterService) {}

    public function __invoke(CreateMovieCommand $command): void
    {
        $movies = [];
        $categories = [];
        foreach ($command->getMovies() as $movie) {
            $movieObject = new Movie();
            $movieObject->setTitle($movie[Movie::COLUMN_TITLE]);
            $movieObject->setActive($movie[Movie::COLUMN_ACTIVE]);
            foreach ($movie[Movie::RELATION_CATEGORIES] as $categoryName) {
                // tu sprawdzić czy istnieje już kategoria
                $categoryObject = new Category();
                $categoryObject->setName($categoryName);
                $categoryObject->setMovie($movieObject);
                $categories[] = $categoryObject;
            }
            $movies[] = $movieObject;
        }
        $this->movieWriterService->saveMoviesInDB($movies, $categories);
    }
}