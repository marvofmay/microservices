<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class UpdateUserCommand
{
    public string $uuid;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public bool $active;
    public ?\DateTimeInterface $bornOn;
    public array $roles;
    public array $skills;
    public array $interests;
    public User $user;
    public array $addresses;

    public function __construct(
        string $uuid,
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        bool $active,
        ?\DateTimeInterface $bornOn,
        array $roles,
        array $skills,
        array $interests,
        array $addresses,
        User $user
    )
    {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->active = $active;
        $this->bornOn = $bornOn;
        $this->roles = $roles;
        $this->skills = $skills;
        $this->interests = $interests;
        $this->user = $user;
        $this->addresses = $addresses;
    }
}