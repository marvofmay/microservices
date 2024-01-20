<?php

namespace App\User\Application\CommandHandler\SelectOption;

use App\User\Application\Command\SelectOption\RestoreDeletedSelectOptionCommand;
use Doctrine\ORM\EntityManagerInterface;

class RestoreDeletedSelectOptionCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(RestoreDeletedSelectOptionCommand $command): void
    {
        $selectOption = $command->getSelectOption();
        $selectOption->setDeletedAt(null);
        $this->entityManager->flush();
    }
}