<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\DeleteMovieCommand;
use App\Movie\Domain\Service\WriterService\MovieWriterService;

class DeleteMovieCommandHandler
{
    private MovieWriterService $movieWriterService;

    public function __construct(MovieWriterService $movieWriterService)
    {
        $this->movieWriterService = $movieWriterService;
    }

    public function __invoke(DeleteMovieCommand $command): void
    {
        $movie = $command->getMovie();
        $movie->setActive(false);
        $movie->setDeletedAt(new \DateTime());
        $this->movieWriterService->saveMovieInDB($movie);
    }
}