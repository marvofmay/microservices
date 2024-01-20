<?php

namespace App\User\Application\CommandHandler\SelectOption;

use App\User\Application\Command\SelectOption\DeleteSelectOptionCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteSelectOptionCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(DeleteSelectOptionCommand $command): void
    {
        $selectOption = $command->getSelectOption();
        $this->entityManager->remove($selectOption);
        $this->entityManager->flush();
    }
}