<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Action;

use App\Movie\Application\Command\ToggleActiveCommand;
use App\Movie\Domain\Entity\Movie;
use Symfony\Component\Messenger\MessageBusInterface;

class ToggleActiveAction
{

    public function __construct(private readonly MessageBusInterface $commandBus, private Movie $movie)
    {
    }

    public function setMovieToggleActive(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new ToggleActiveCommand($this->movie));
    }
}