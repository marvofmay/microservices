<?php

namespace App\User\Domain\Interface\User;

use App\User\Domain\Entity\User;

interface UserReaderInterface
{
    public function getUserByUUID(string $uuid): ?User;
    public function getNotDeletedUserByUUID(string $uuid): ?User;
    public function getUsers(): mixed;
    public function getUserByEmail(string $email): ?User;
    public function getUserByEmailAndNotEqualUUID(string $email, string $uuid): ?User;
}