<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOption;

use App\User\Application\Command\SelectOption\UpdateSelectOptionCommand;
use App\User\Domain\Entity\SelectOption;
use Symfony\Component\Messenger\MessageBusInterface;
use App\User\Domain\DTO\SelectOption\UpdateDTO;

class UpdateSelectOptionAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private SelectOption $selectOption)
    {
    }

    public function setSelectOptionToUpdate(SelectOption $selectOption): self
    {
        $this->selectOption = $selectOption;

        return $this;
    }

    public function getSelectOption(): SelectOption
    {
        return $this->selectOption;
    }

    public function execute(UpdateDTO $updateDTO): void
    {
        $this->commandBus->dispatch(
            new UpdateSelectOptionCommand(
                $updateDTO->getUUID(),
                $updateDTO->getValue(),
                $updateDTO->getName(),
                $updateDTO->getKind(),
                $this->getSelectOption()
            )
        );
    }
}