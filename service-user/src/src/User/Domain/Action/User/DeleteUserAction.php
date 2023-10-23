<?php

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\DeleteUserCommand;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteUserAction
{
    private MessageBusInterface $commandBus;
    private User $user;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUserToDelete(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new DeleteUserCommand($this->user));
    }
}