<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\ChangeUserPasswordCommand;
use App\User\Domain\DTO\User\ChangePasswordDTO;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class ChangeUserPasswordAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private User $user) {}

    public function setUserToChangePassword(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function execute(ChangePasswordDTO $changePasswordDTO): void
    {
        $this->commandBus->dispatch(new ChangeUserPasswordCommand(
            $changePasswordDTO->getNewPassword(),
            $this->user
        ));
    }
}