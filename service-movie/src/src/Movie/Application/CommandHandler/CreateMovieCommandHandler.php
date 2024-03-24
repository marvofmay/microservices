<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Domain\Entity\Category;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Service\Movie\WriterService\MovieWriterService;

class CreateMovieCommandHandler
{
    public function __construct(private readonly MovieWriterService $movieWriterService) {}

    public function __invoke(CreateMovieCommand $command): void
    {
        $movies = [];
        foreach ($command->getMovies() as $movie) {
            $movieObject = new Movie();
            $movieObject->setTitle($movie[Movie::COLUMN_TITLE]);
            $movieObject->setActive($movie[Movie::COLUMN_ACTIVE]);
            foreach ($movie[Movie::RELATION_CATEGORIES] as $categoryName) {
                $categoryObject = new Category();
                $categoryObject->setName($categoryName);
                $movieObject->addCategory($categoryObject);
            }
            $movies[] = $movieObject;
        }
        $this->movieWriterService->saveMoviesAndCategoriesInDB($movies);
    }
}