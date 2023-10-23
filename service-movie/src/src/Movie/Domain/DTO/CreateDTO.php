<?php

namespace App\Movie\Domain\DTO;

use App\Movie\Domain\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;

class CreateDTO
{
    private array $data;
    private ?array $movies;

    public function __construct(Request $request)
    {
        $this->data = ! empty($request->getContent()) ? json_decode($request->getContent(), true) : [];
        $this->movies =  ! empty($this->data['movies']) ? $this->getUniqueTitle($this->data['movies']) : null;
    }

    public function getMovies (): ?array
    {
        return $this->movies;
    }

    private function getUniqueTitle(array $movies): array
    {
        return array_values(array_reduce($movies, function ($items, $movie) {
            $title = strtolower($movie[Movie::COLUMN_TITLE]);
            if (!isset($items[$title])) {
                $items[$title] = $movie;
            }
            return $items;
        }, []));
    }
}