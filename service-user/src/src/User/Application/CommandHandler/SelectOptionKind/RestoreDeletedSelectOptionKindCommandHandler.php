<?php

namespace App\User\Application\CommandHandler\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\RestoreDeletedSelectOptionKindCommand;
use Doctrine\ORM\EntityManagerInterface;

class RestoreDeletedSelectOptionKindCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(RestoreDeletedSelectOptionKindCommand $command): void
    {
        $selectOptionKind = $command->getSelectOptionKind();
        $selectOptionKind->setDeletedAt(null);
        $this->entityManager->flush();
    }
}