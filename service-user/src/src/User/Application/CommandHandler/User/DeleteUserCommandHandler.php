<?php

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\DeleteUserCommand;
use App\User\Domain\Service\WriterService\UserWriterService;

class DeleteUserCommandHandler
{
    private UserWriterService $userWriterService;

    public function __construct(UserWriterService $userWriterService)
    {
        $this->userWriterService = $userWriterService;
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $user = $command->user;
        $user->setActive(false);
        $user->setDeletedAt(new \DateTime());
        $this->userWriterService->saveUserInDB($user);
    }
}