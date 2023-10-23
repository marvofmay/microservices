<?php

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\UpdateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Presentation\Request\User\UpdateRequest;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateUserAction
{
    private MessageBusInterface $commandBus;
    private UpdateRequest $updateRequest;
    private User $user;

    public function __construct(UpdateRequest $updateRequest, MessageBusInterface $commandBus)
    {
        $this->updateRequest = $updateRequest;
        $this->commandBus = $commandBus;
    }

    public function setUserToUpdate(User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function execute(): void
    {
        $this->commandBus->dispatch(new UpdateUserCommand(
            $this->updateRequest->getUUID(),
            $this->updateRequest->getFirstName(),
            $this->updateRequest->getLastName(),
            $this->updateRequest->getEmail(),
            $this->updateRequest->getPhone(),
            $this->updateRequest->getPassword(),
            $this->updateRequest->getActive(),
            $this->updateRequest->getRoles(),
            $this->user
        ));
    }
}