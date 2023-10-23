<?php

namespace App\User\Application\Command\User;

class RegisterUserCommand
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $password;
    public bool $active;
    public array $roles;

    public function __construct(string $firstName, string $lastName, string $email, string $phone, string $password, bool $active, array $roles)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->active = $active;
        $this->roles = $roles;
    }
}