<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Action;

use App\Movie\Application\Command\RestoreDeletedMovieCommand;
use App\Movie\Domain\Entity\Movie;
use Symfony\Component\Messenger\MessageBusInterface;

class RestoreDeleteAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, public Movie $movie)
    {
    }

    public function setMovieToRestore(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
    public function execute(): void
    {
        $this->commandBus->dispatch(new RestoreDeletedMovieCommand($this->movie));
    }
}