<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class UpdateUserCommand
{
    public function __construct(
        public string $uuid,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public bool $active,
        public ?\DateTimeInterface $bornOn,
        public array $roles,
        public array $skills,
        public array $interests,
        public array $addresses,
        public User $user
    ) {}
}