<?php

declare(strict_types = 1);

namespace App\Movie\Domain\DTO;

use App\Movie\Domain\Entity\Movie;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ListingMovieDTO implements RequestDtoInterface
{
    #[Assert\Choice([1, 2, 3], message: 'Only 1 or 2 or 3 value')]
    public int $algorithm;

    #[Assert\LessThanOrEqual(value: 100)]
    public int $limit = 10;

    public int $page = 1;

    public string $sort = '-' . Movie::COLUMN_CREATED_AT;

    public ?string $title = null;

    public ?bool $active = null;

    public ?bool $deleted = null;

    public ?string $phrase = null;
}