<?php

declare(strict_types = 1);

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\ToggleActiveCommand;
use App\Movie\Domain\Service\Movie\WriterService\MovieWriterService;

class ToggleActiveMovieCommandHandler
{
    public function __construct(private readonly MovieWriterService $movieWriterService) {}

    public function __invoke(ToggleActiveCommand $command): void
    {
        $movie = $command->getMovie();
        $movie->setActive(! $movie->getActive());

        $this->movieWriterService->saveMovieInDB($movie);
    }
}