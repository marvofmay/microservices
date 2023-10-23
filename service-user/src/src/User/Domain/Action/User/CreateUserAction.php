<?php

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\CreateUserCommand;
use App\User\Presentation\Request\User\CreateRequest;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserAction
{
    private MessageBusInterface $commandBus;
    private CreateRequest $createRequest;

    public function __construct(CreateRequest $createRequest, MessageBusInterface $commandBus)
    {
        $this->createRequest = $createRequest;
        $this->commandBus = $commandBus;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new CreateUserCommand(
            $this->createRequest->getFirstName(),
            $this->createRequest->getLastName(),
            $this->createRequest->getEmail(),
            $this->createRequest->getPhone(),
            $this->createRequest->getPassword(),
            $this->createRequest->getActive(),
            $this->createRequest->getRoles()
        ));
    }
}