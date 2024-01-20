<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOption;

use App\User\Application\Command\SelectOption\DeleteSelectOptionCommand;
use App\User\Domain\Entity\SelectOption;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteSelectOptionAction
{
    public function __construct(private readonly MessageBusInterface $commandBus, private SelectOption $selectOption)
    {
    }

    public function setSelectOptionToDelete(SelectOption $selectOption): self
    {
        $this->selectOption = $selectOption;

        return $this;
    }

    public function execute(): void
    {
        $this->commandBus->dispatch(new DeleteSelectOptionCommand($this->selectOption));
    }
}