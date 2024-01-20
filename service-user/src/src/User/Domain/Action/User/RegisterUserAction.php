<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\RegisterUserCommand;
use App\User\Domain\DTO\User\RegisterDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterUserAction
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(RegisterDTO $registerDTO): void
    {
        $this->commandBus->dispatch(new RegisterUserCommand(
            $registerDTO->getFirstName(),
            $registerDTO->getLastName(),
            $registerDTO->getEmail(),
            $registerDTO->getPhone(),
            $registerDTO->getPassword()
        ));
    }
}