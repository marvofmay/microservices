<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\UpdateSelectOptionKindCommand;
use App\User\Domain\Entity\SelectOptionKind;
use Symfony\Component\Messenger\MessageBusInterface;
use App\User\Domain\DTO\SelectOptionKind\UpdateDTO;

class UpdateSelectOptionKindAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private SelectOptionKind $selectOptionKind) {}

    public function setSelectOptionKindToUpdate(SelectOptionKind $selectOptionKind): self
    {
        $this->selectOptionKind = $selectOptionKind;

        return $this;
    }

    public function getSelectOptionKind(): SelectOptionKind
    {
        return $this->selectOptionKind;
    }

    public function execute(UpdateDTO $updateDTO): void
    {
        $this->commandBus->dispatch(
            new UpdateSelectOptionKindCommand(
                $updateDTO->getUUID(),
                $updateDTO->getName(),
                $this->getSelectOptionKind()
            )
        );
    }
}