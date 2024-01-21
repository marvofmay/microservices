<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\CreateSelectOptionKindCommand;
use App\User\Domain\Entity\SelectOptionKind;
use App\User\Domain\Service\SelectOptionKind\WriterService\SelectOptionKindWriterService;

class CreateSelectOptionKindCommandHandler
{
    public function __construct(private readonly SelectOptionKindWriterService $selectOptionKindWriterService) { }

    public function __invoke(CreateSelectOptionKindCommand $command): void
    {
        $newOption = new SelectOptionKind();
        $newOption->setName($command->name);

        $this->selectOptionKindWriterService->saveSelectOptionKindInDB($newOption);
    }
}