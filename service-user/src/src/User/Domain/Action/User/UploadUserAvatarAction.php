<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\UploadUserAvatarCommand;
use App\User\Domain\DTO\User\UploadUserAvatarDTO;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class UploadUserAvatarAction
{
    private MessageBusInterface $commandBus;
    private User $user;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function execute(UploadUserAvatarDTO $uploadUserAvatarDTO): void
    {
        $this->commandBus->dispatch(new UploadUserAvatarCommand(
            $uploadUserAvatarDTO->getAvatar(),
            $this->getUser()
        ));
    }
}