<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\UpdateUserCommand;
use App\User\Domain\DTO\User\UpdateDTO;
use App\User\Domain\Entity\User;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateUserAction
{
    private MessageBusInterface $commandBus;
    private User $user;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function setUserToUpdate(User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function execute(UpdateDTO $updateDTO): void
    {
        $this->commandBus->dispatch(new UpdateUserCommand(
            $updateDTO->getUUID(),
            $updateDTO->getFirstName(),
            $updateDTO->getLastName(),
            $updateDTO->getEmail(),
            $updateDTO->getPhone(),
            $updateDTO->getActive(),
            $updateDTO->getBornOn(),
            $updateDTO->getRoles(),
            $updateDTO->getSkills(),
            $updateDTO->getInterests(),
            $updateDTO->getAddresses(),
            $this->user
        ));
    }
}