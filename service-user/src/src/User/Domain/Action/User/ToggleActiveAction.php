<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\ToggleActiveCommand;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class ToggleActiveAction
{
    private MessageBusInterface $commandBus;
    private User $user;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUserToggleActive(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new ToggleActiveCommand($this->user));
    }
}