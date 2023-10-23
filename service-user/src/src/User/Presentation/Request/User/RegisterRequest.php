<?php

namespace App\User\Presentation\Request\User;

use Symfony\Component\HttpFoundation\Request;

class RegisterRequest extends Request
{
    private array $data;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $phone;
    private string $password;

    public function __construct()
    {
        parent::__construct();
        $this->data = ! empty($this->getContent()) ? json_decode($this->getContent(), true) : [];
    }

    public function getFirstName (): ?string
    {
        $this->firstName = $this->data['firstName'] ?? null;

        return $this->firstName;
    }
    public function getLastName (): ?string
    {
        $this->lastName = $this->data['lastName'] ?? null;

        return $this->lastName;
    }
    public function getEmail (): ?string
    {
        $this->email = $this->data['email'] ?? null;

        return $this->email;
    }
    public function getPhone (): ?string
    {
        $this->phone = $this->data['phone'] ?? null;

        return $this->phone;
    }

    public function getPassword(): ?string
    {
        return $this->data['password'] ?? null;
    }
}