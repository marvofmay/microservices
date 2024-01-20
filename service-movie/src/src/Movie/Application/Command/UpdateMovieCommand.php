<?php

namespace App\Movie\Application\Command;


use App\Movie\Domain\Entity\Movie;

class UpdateMovieCommand
{
    public function __construct(
        public string $uuid,
        public string $title,
        public bool $active,
        public array $categories,
        public Movie $movie
    ) {}

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}