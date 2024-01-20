<?php

declare(strict_types = 1);

namespace App\Movie\Domain\DTO;

use App\Movie\Domain\Entity\Movie;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateMovieDTO implements RequestDtoInterface
{
    #[Assert\NotBlank]
    #[Assert\All([
        new Assert\Collection(
            fields: [
                'title' => [
                    new Assert\NotBlank,
                    new Assert\Length(min: 3, max: 255),
                ],
                'active' => [
                    new Assert\Type('boolean'),
                ],
                'categories' => [
                    new Assert\NotBlank,
                    new Assert\Type('array'),
                    new Assert\Count(min: 1, minMessage: "At least one category is required")
                ]
            ],
            allowExtraFields: false,
            allowMissingFields: false,
        )
    ])]
    public array $movies;

    public function getMovies (): array
    {
        $this->movies = $this->getUniqueTitle();

        return $this->movies;
    }

    private function getUniqueTitle(): array
    {
        return array_values(array_reduce($this->movies, function ($items, $movie) {
            $title = strtolower($movie[Movie::COLUMN_TITLE]);
            if (!isset($items[$title])) {
                $items[$title] = $movie;
            }

            return $items;
        }, []));
    }
}