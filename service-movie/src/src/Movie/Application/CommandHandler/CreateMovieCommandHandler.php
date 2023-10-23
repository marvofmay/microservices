<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Domain\Service\WriterService\MovieWriterService;

class CreateMovieCommandHandler
{
    private MovieWriterService $movieWriterService;

    public function __construct(MovieWriterService $movieWriterService)
    {
        $this->movieWriterService = $movieWriterService;
    }

    public function __invoke(CreateMovieCommand $command): void
    {
        $movies = [];
        foreach ($command->getMovies() as $movie) {
            $movieObject = new Movie();
            $movieObject->setTitle($movie[Movie::COLUMN_TITLE]);
            $movieObject->setActive($movie[Movie::COLUMN_ACTIVE]);
            $movies[] = $movieObject;
        }

        $this->movieWriterService->saveMoviesInDB($movies);
    }
}