<?php

namespace App\User\Domain\Interface\User;

use App\User\Domain\Entity\User;

interface UserWriterInterface
{
    function saveUserInDB(User $user, array $roles, array $addresses = [], array $skills = [], array $interests = []): User;
    function updateUserInDB(User $user, array $roles, array $addresses, array $skills, array $interests): User;
}