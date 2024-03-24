<?php

declare(strict_types = 1);

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\RestoreDeletedMovieCommand;
use App\Movie\Domain\Service\Movie\WriterService\MovieWriterService;

class RestoreDeletedMovieCommandHandler
{
    public function __construct(private readonly MovieWriterService $movieWriterService) {}

    public function __invoke(RestoreDeletedMovieCommand $command): void
    {
        $movie = $command->movie;
        $movie->setActive(false);
        $movie->setDeletedAt(null);
        $this->movieWriterService->saveMovieInDB($movie);
    }
}