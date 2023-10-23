<?php

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\CreateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\Service\WriterService\UserWriterService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommandHandler
{
    private UserWriterService $userWriterService;
    private UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(UserWriterService $userWriterService, UserPasswordHasherInterface $userPasswordInterface)
    {
        $this->userWriterService = $userWriterService;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $user = new User();
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