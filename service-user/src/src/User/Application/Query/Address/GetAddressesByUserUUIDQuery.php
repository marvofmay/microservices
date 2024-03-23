<?php

declare(strict_types = 1);

namespace App\User\Application\Query\Address;

class GetAddressesByUserUUIDQuery
{
    public function __construct(private string $userUUID) {}

    public function getUserUUID(): string
    {
        return $this->userUUID;
    }
}