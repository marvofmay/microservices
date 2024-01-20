<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\SelectOption;

use App\User\Application\Command\SelectOption\CreateSelectOptionCommand;
use App\User\Domain\Entity\SelectOption;
use App\User\Domain\Service\SelectOption\WriterService\SelectOptionWriterService;

class CreateSelectOptionCommandHandler
{
    public function __construct(private readonly SelectOptionWriterService $selectOptionWriterService) { }

    public function __invoke(CreateSelectOptionCommand $command): void
    {
        $newOption = new SelectOption();
        $newOption->setValue($command->value);
        $newOption->setName($command->name);
        $newOption->setKind($command->kind);

        $this->selectOptionWriterService->saveSelectOptionInDB($newOption);
    }
}