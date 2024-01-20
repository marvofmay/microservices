<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Structure\UserRole\User;

class RegisterUserCommand
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public string $password;
    public bool $active;
    public array $roles;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $password,
        bool $active = true,
        array $roles = [User::ROLE_USER_VALUE]
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->active = $active;
        $this->roles = $roles;
    }
}