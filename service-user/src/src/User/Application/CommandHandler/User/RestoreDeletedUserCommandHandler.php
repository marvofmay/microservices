<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\RestoreDeletedUserCommand;
use App\User\Domain\Service\User\WriterService\UserWriterService;

class RestoreDeletedUserCommandHandler
{
    public function __construct(private readonly UserWriterService $userWriterService) {}

    public function __invoke(RestoreDeletedUserCommand $command): void
    {
        $user = $command->user;
        $user->setActive(false);
        $user->setDeletedAt(null);
        $this->userWriterService->saveUserInDB($user);
    }
}