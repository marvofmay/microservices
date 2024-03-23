<?php

namespace App\User\Domain\Interface;

use App\User\Domain\Entity\User;

interface UserWriterInterface
{
    public function saveUserInDB(User $user, array $roles, array $addresses = [], array $skills = [], array $interests = []): User;
    public function updateUserInDB(User $user, array $roles, array $addresses, array $skills, array $interests): User;
}