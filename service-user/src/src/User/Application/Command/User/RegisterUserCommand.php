<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Structure\UserRole\User;

class RegisterUserCommand
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $password,
        public bool $active = true,
        public array $roles = [User::ROLE_USER_VALUE]
    ) {}
}