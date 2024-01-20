<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\User;

use App\User\Application\Command\User\CreateUserCommand;
use App\User\Domain\DTO\User\CreateDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserAction
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute(CreateDTO $createDTO): void
    {
        $this->commandBus->dispatch(new CreateUserCommand(
            $createDTO->getFirstName(),
            $createDTO->getLastName(),
            $createDTO->getEmail(),
            $createDTO->getPhone(),
            $createDTO->getPassword(),
            $createDTO->getActive(),
            $createDTO->getBornOn(),
            $createDTO->getRoles(),
            $createDTO->getSkills(),
            $createDTO->getInterests(),
            $createDTO->getAddresses(),
        ));
    }
}