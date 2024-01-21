<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\UpdateSelectOptionKindCommand;
use App\User\Domain\Entity\SelectOptionKind;
use App\User\Domain\Service\SelectOptionKind\WriterService\SelectOptionKindWriterService;

class UpdateSelectOptionKindCommandHandler
{
    public function __construct(
        private readonly SelectOptionKindWriterService $selectOptionKindWriterService,
        private SelectOptionKind $selectOptionKind) { }

    public function __invoke(UpdateSelectOptionKindCommand $command): void
    {
        $this->selectOptionKind = $command->getSelectOptionKind();
        $this->selectOptionKind->setName($command->getName());

        $this->selectOptionKindWriterService->updateSelectOptionKindInDB($this->selectOptionKind);
    }
}