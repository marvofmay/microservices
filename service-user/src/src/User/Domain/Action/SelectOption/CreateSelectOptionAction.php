<?php

declare(strict_types = 1);

namespace App\User\Domain\Action\SelectOption;

use App\User\Application\Command\SelectOption\CreateSelectOptionCommand;
use App\User\Domain\DTO\SelectOption\CreateDTO;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateSelectOptionAction
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    { }

    public function execute(CreateDTO $createDTO): void
    {
        $this->commandBus->dispatch(
            new CreateSelectOptionCommand(
                $createDTO->getValue(),
                $createDTO->getName(),
                $createDTO->getKind()
            )
        );
    }
}