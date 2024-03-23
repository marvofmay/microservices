<?php

namespace App\Movie\Domain\Action;

use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Domain\DTO\CreateMovieDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateMovieAction
{
    public function __construct(private readonly MessageBusInterface $commandBus) {}

    public function execute(CreateMovieDTO $createMovieDTO): void
    {
        $this->commandBus->dispatch(new CreateMovieCommand($createMovieDTO->getMovies()));
    }
}