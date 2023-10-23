<?php

namespace App\Movie\Domain\DTO;

use Symfony\Component\HttpFoundation\Request;

class UpdateDTO
{
    private array $data;
    private ?string $uuid;
    private ?string $title;
    private null|string|bool $active;

    public function __construct(Request $request)
    {
        $this->data = ! empty($request->getContent()) ? json_decode($request->getContent(), true) : [];
        $this->uuid = $this->data['uuid'] ?? null;
        $this->title = $this->data['title'] ?? null;
        $this->active = $this->data['active'] ?? null;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getActive(): bool|string|null
    {
        return $this->active;
    }
}