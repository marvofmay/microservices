<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\ChangeUserPasswordCommand;
use App\User\Domain\Service\User\WriterService\UserWriterService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangeUserPasswordCommandHandler
{
    public function __construct(private readonly UserWriterService $userWriterService, private readonly UserPasswordHasherInterface $userPasswordInterface) {}

    public function __invoke(ChangeUserPasswordCommand $command): void
    {
        $user = $command->user;
        $user->setPassword($command->newPassword, $this->userPasswordInterface);

        $this->userWriterService->updateUserInDB($user);
    }
}