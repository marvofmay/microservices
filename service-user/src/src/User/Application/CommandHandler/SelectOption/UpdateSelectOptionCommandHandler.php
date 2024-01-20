<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\SelectOption;

use App\User\Application\Command\SelectOption\UpdateSelectOptionCommand;
use App\User\Domain\Entity\SelectOption;
use App\User\Domain\Service\SelectOption\WriterService\SelectOptionWriterService;

class UpdateSelectOptionCommandHandler
{
    public function __construct(private readonly SelectOptionWriterService $selectOptionWriterService, private SelectOption $selectOption)
    {
    }

    public function __invoke(UpdateSelectOptionCommand $command): void
    {
        $this->selectOption = $command->getSelectOption();
        $this->selectOption->setValue($command->getValue());
        $this->selectOption->setName($command->getName());
        $this->selectOption->setKind($command->getKind());

        $this->selectOptionWriterService->updateSelectOptionInDB($this->selectOption);
    }
}