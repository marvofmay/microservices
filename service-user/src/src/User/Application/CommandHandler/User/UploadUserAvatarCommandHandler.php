<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\UploadUserAvatarCommand;
use App\User\Domain\Service\User\WriterService\UserWriterService;

class UploadUserAvatarCommandHandler
{
    private UserWriterService $userWriterService;

    public function __construct(UserWriterService $userWriterService)
    {
        $this->userWriterService = $userWriterService;
    }

    public function __invoke(UploadUserAvatarCommand $command): void
    {
        $user = $command->user;
        $user->setAvatar($command->avatar);

        $this->userWriterService->saveUserInDB($user);
    }
}