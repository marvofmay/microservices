<?php

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\UpdateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\Service\ReaderService\UserReaderService;
use App\User\Domain\Service\WriterService\UserWriterService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdateUserCommandHandler
{
    private UserWriterService $userWriterService;
    private UserReaderService $userReaderService;
    private UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(UserWriterService $userWriterService, UserReaderService $userReaderService, UserPasswordHasherInterface $userPasswordInterface)
    {
        $this->userWriterService = $userWriterService;
        $this->userReaderService = $userReaderService;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $user = $command->user;
        $user->setFirstName($command->{User::COLUMN_FIRST_NAME});
        $user->setLastName($command->{User::COLUMN_LAST_NAME});
        $user->setPhone($command->{User::COLUMN_PHONE});
        $user->setEmail($command->{User::COLUMN_EMAIL});
        $user->setPassword($command->{User::COLUMN_PASSWORD}, $this->userPasswordInterface);
        $user->setActive($command->{User::COLUMN_ACTIVE});
        $user->setRoles($command->{User::COLUMN_ROLES});

        $this->userWriterService->saveUserInDB($user);
    }
}