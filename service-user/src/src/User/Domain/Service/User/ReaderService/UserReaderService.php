<?php

namespace App\User\Domain\Service\User\ReaderService;

use App\User\Domain\Entity\User;
use App\User\Domain\Interface\User\UserReaderInterface;

class UserReaderService
{
    public function __construct(private readonly UserReaderInterface $userReaderRepository) {}

    public function getUserByUUID(string $uuid): ?User
    {
        return $this->userReaderRepository->getUserByUUID($uuid);
    }

    public function getNotDeletedUserByUUID(string $uuid): ?User
    {
        return $this->userReaderRepository->getNotDeletedUserByUUID($uuid);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userReaderRepository->getUserByEmail($email);
    }

    public function isEmailUsed(string $email, string $uuid): bool
    {
        return ! empty($this->userReaderRepository->getUserByEmailAndNotEqualUUID($email, $uuid));
    }

    public function getUsers()
    {
        return $this->userReaderRepository->getUsers();
    }
}