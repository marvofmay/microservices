<?php

declare(strict_types = 1);

namespace App\Movie\Domain\DTO;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateMovieDTO implements RequestDtoInterface
{
    #[Assert\NotBlank]
    public string $uuid;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $title;

    #[Assert\Type('boolean')]
    public bool $active;

    #[Assert\NotBlank]
    #[Assert\Type('array')]
    #[Assert\Count(min: 1, minMessage: "At least one category is required")]
    public array $categories;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getActive(): booL
    {
        return $this->active;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
}