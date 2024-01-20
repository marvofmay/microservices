<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\RestoreDeletedUserCommand;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class RestoreDeleteAction
{
    private MessageBusInterface $commandBus;
    private User $user;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUserToRestore(User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function execute(): void
    {
        $this->commandBus->dispatch(new RestoreDeletedUserCommand($this->user));
    }
}