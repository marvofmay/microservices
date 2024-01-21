<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\RestoreDeletedSelectOptionKindCommand;
use App\User\Domain\Entity\SelectOptionKind;
use Symfony\Component\Messenger\MessageBusInterface;

class RestoreDeletedSelectOptionKindAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private SelectOptionKind $selectOptionKind)
    {
    }

    public function setSelectOptionKindToRestore(SelectOptionKind $selectOptionKind): self
    {
        $this->selectOptionKind = $selectOptionKind;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new RestoreDeletedSelectOptionKindCommand($this->selectOptionKind));
    }
}