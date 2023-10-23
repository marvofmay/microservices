<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\UpdateMovieCommand;
use App\Movie\Domain\Service\WriterService\MovieWriterService;

class UpdateMovieCommandHandler
{
    private MovieWriterService $movieWriterService;

    public function __construct(MovieWriterService $movieWriterService)
    {
        $this->movieWriterService = $movieWriterService;
    }

    public function __invoke(UpdateMovieCommand $command): void
    {
        $movie = $command->getMovie();
        $movie->setTitle($command->getTitle());
        $movie->setActive($command->getActive());

        $this->movieWriterService->saveMovieInDB($movie);
    }
}