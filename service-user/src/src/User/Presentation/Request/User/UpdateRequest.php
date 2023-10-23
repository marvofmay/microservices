<?php

namespace App\User\Presentation\Request\User;

use Symfony\Component\HttpFoundation\Request;

class UpdateRequest extends Request
{
    private array $data;
    public ?string $uuid;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $phone;
    public string $password;
    public bool $active;
    public array $roles;

    public function __construct()
    {
        parent::__construct();
        $this->data = ! empty($this->getContent()) ? json_decode($this->getContent(), true) : [];
    }

    public function getUUID (): ?string
    {
        $this->uuid = $this->data['uuid'] ?? null;

        return $this->uuid;
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

    public function getActive(): bool
    {
        return $this->data['active'] ?? false;
    }

    public function getRoles(): array
    {
        return $this->data['roles'] ?? [];
    }
}