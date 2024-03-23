<?php

namespace App\User\Domain\Service\User\WriterService;

use App\User\Domain\Entity\User;
use App\User\Domain\Interface\UserWriterInterface;

class UserWriterService
{
    public function __construct(private readonly UserWriterInterface $userWriterRepository) {}

    public function __toString()
    {
        return 'UserWriterService';
    }

    public function saveUserInDB (User $user, array $roles = [], array $addresses = [], array $skills = [], array $interests = []): User
    {
        return $this->userWriterRepository->saveUserInDB($user, $roles, $addresses, $skills, $interests);
    }

    public function updateUserInDB (User $user, array $roles = [], array $addresses = [], array $skills = [], array $interests = []): User
    {
        return $this->userWriterRepository->updateUserInDB($user, $roles, $addresses, $skills, $interests);
    }
}