<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\User;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterDTO implements RequestDtoInterface
{
    #[Assert\NotBlank(message: "Firstname is required")]
    #[Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $firstName;

    #[Assert\NotBlank(message: "Lastname is required")]
    #[Assert\Length(min: 3, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $lastName;

    #[Assert\NotBlank()]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    public string $email;

    #[Assert\NotBlank()]
    public string $phone;

    #[Assert\NotBlank()]
    public string $password;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}