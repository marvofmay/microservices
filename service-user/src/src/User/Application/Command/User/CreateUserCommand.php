<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

class CreateUserCommand
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $password;
    public bool $active;
    public ?\DateTimeInterface $bornOn;
    public array $roles;
    public array $skills;
    public array $interests;
    public array $addresses;

    public function __construct(string $firstName, string $lastName, string $email, string $phone, string $password, bool $active, ?\DateTimeInterface $bornOn, array $roles, array $skills, array $interests, array $addresses)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->active = $active;
        $this->bornOn = $bornOn;
        $this->roles = $roles;
        $this->skills = $skills;
        $this->interests = $interests;
        $this->addresses = $addresses;
    }
}