<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

class CreateUserCommand
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $password,
        public bool $active,
        public ?\DateTimeInterface $bornOn,
        public array $roles,
        public array $skills,
        public array $interests,
        public array $addresses
    ) {}
}