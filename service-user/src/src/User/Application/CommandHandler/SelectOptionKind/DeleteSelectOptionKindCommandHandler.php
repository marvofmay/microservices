<?php

namespace App\User\Application\CommandHandler\SelectOptionKind;

use App\User\Application\Command\SelectOptionKind\DeleteSelectOptionKindCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteSelectOptionKindCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(DeleteSelectOptionKindCommand $command): void
    {
        $selectOptionKind = $command->getSelectOptionKind();
        $this->entityManager->remove($selectOptionKind);
        $this->entityManager->flush();
    }
}