<?php

declare(strict_types = 1);

namespace App\User\Application\Query\Address;

class GetAddressesByUserUUIDQuery
{
    private string $userUUID;

    public function __construct(string $userUUID)
    {
        $this->userUUID = $userUUID;
    }

    public function getUserUUID(): string
    {
        return $this->userUUID;
    }
}