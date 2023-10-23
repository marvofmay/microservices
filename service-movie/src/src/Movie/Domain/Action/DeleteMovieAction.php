<?php

namespace App\Movie\Domain\Action;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Application\Command\DeleteMovieCommand;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteMovieAction
{
    private MessageBusInterface $commandBus;
    private Movie $movie;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setMovieToDelete(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new DeleteMovieCommand($this->movie));
    }
}