<?php

namespace App\User\Domain\Interface\User;

use App\User\Domain\Entity\User;

interface UserReaderInterface
{
    function getUserByUUID(string $uuid): ?User;
    function getNotDeletedUserByUUID(string $uuid): ?User;
    function getUsers(): mixed;
    function getUserByEmail(string $email): ?User;
    function getUserByEmailAndNotEqualUUID(string $email, string $uuid): ?User;
}