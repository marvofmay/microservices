<?php

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\RegisterUserCommand;
use App\User\Presentation\Request\User\RegisterRequest;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterUserAction
{
    private MessageBusInterface $commandBus;
    private RegisterRequest $registerRequest;

    public function __construct(MessageBusInterface $commandBus, RegisterRequest $registerRequest)
    {
        $this->commandBus = $commandBus;
        $this->registerRequest = $registerRequest;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new RegisterUserCommand(
            $this->registerRequest->getFirstName(),
            $this->registerRequest->getLastName(),
            $this->registerRequest->getEmail(),
            $this->registerRequest->getPhone(),
            $this->registerRequest->getPassword(),
            true,
            ['ROLE_USER']
        ));
    }
}