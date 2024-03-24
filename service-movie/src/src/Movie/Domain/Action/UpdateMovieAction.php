<?php

namespace App\Movie\Domain\Action;

use App\Movie\Domain\DTO\UpdateMovieDTO;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Application\Command\UpdateMovieCommand;;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateMovieAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private Movie $movie) {}

    public function setMovieToUpdate(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
    public function execute(UpdateMovieDTO $updateMovieDTO): void
    {
        $this->commandBus->dispatch(
            new UpdateMovieCommand(
                $updateMovieDTO->getUUID(),
                $updateMovieDTO->getTitle(),
                $updateMovieDTO->getActive(),
                $updateMovieDTO->getCategories(),
                $this->movie
        ));
    }
}