<?php

namespace App\Movie\Domain\Action;

use App\Movie\Domain\DTO\UpdateDTO;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Application\Command\UpdateMovieCommand;;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateMovieAction
{
    private MessageBusInterface $commandBus;
    private Movie $movie;
    private UpdateDTO $updateDTO;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUpdateDTO(UpdateDTO $updateDTO): self
    {
        $this->updateDTO = $updateDTO;

        return $this;
    }

    public function setMovieToUpdate(Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
    public function execute(): void
    {
        $this->commandBus->dispatch(new UpdateMovieCommand(
            $this->updateDTO->getUUID(),
            $this->updateDTO->getTitle(),
            $this->updateDTO->getActive(),
            $this->movie
        ));
    }
}