<?php

namespace App\Movie\Domain\Action;

use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Domain\DTO\CreateDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateMovieAction
{
    private MessageBusInterface $commandBus;
    private CreateDTO $createDTO;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setCreateDTO(CreateDTO $createDTO): self
    {
        $this->createDTO = $createDTO;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new CreateMovieCommand(
            $this->createDTO->getMovies()
        ));
    }
}