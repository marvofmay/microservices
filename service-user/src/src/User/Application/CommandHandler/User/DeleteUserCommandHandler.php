<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\DeleteUserCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteUserCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $user = $command->getUser();
        $user->setActive(false);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}