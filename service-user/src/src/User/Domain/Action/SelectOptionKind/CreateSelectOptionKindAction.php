<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\CreateSelectOptionKindCommand;
use App\User\Domain\DTO\SelectOptionKind\CreateDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateSelectOptionKindAction
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    { }

    public function execute(CreateDTO $createDTO): void
    {
        $this->commandBus->dispatch(new CreateSelectOptionKindCommand($createDTO->getName()));
    }
}