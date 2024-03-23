<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\RegisterUserCommand;
use App\User\Domain\Entity\Role;
use App\User\Domain\Entity\User;
use App\User\Domain\Service\User\WriterService\UserWriterService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserCommandHandler
{
    public function __construct(
        private readonly UserWriterService $userWriterService,
        private readonly UserPasswordHasherInterface $userPasswordInterface,
        private readonly User $user,
        private array $roles = []
    ) {}

    public function __invoke(RegisterUserCommand $command): void
    {
        $this->setUser($command);
        $this->setRoles($command);
        $this->userWriterService->saveUserInDB($this->user, $this->roles);
    }

    private function setUser(RegisterUserCommand $command): void
    {
        $this->user->setFirstName($command->{User::COLUMN_FIRST_NAME});
        $this->user->setLastName($command->{User::COLUMN_LAST_NAME});
        $this->user->setPhone($command->{User::COLUMN_PHONE});
        $this->user->setEmail($command->{User::COLUMN_EMAIL});
        $this->user->setPassword($command->{User::COLUMN_PASSWORD}, $this->userPasswordInterface);
        $this->user->setActive(true);
    }

    private function setRoles(RegisterUserCommand $command): void
    {
        foreach ($command->roles as $item) {
            $role = new Role();
            $role->setName($item);
            $role->setUser($this->user);

            $this->roles[] = $role;
        }
    }
}