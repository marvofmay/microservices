<?php

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class UpdateUserCommand
{
    public string $uuid;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $password;
    public bool $active;
    public array $roles;
    public User $user;

    public function __construct(string $uuid, string $firstName, string $lastName, string $email, string $phone, string $password, bool $active, array $roles, User $user)
    {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->active = $active;
        $this->roles = $roles;
        $this->user = $user;
    }
}