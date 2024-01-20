<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\ChangeUserPasswordCommand;
use App\User\Domain\Service\User\WriterService\UserWriterService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangeUserPasswordCommandHandler
{
    private UserWriterService $userWriterService;
    private UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(UserWriterService $userWriterService, UserPasswordHasherInterface $userPasswordInterface)
    {
        $this->userWriterService = $userWriterService;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    public function __invoke(ChangeUserPasswordCommand $command): void
    {
        $user = $command->user;
        $user->setPassword($command->newPassword, $this->userPasswordInterface);

        $this->userWriterService->updateUserInDB($user);
    }
}