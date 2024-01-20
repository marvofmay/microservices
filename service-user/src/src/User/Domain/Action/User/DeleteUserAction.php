<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\DeleteUserCommand;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteUserAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private User $user)
    {
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