<?php

namespace App\Movie\Application\Command;


use App\Movie\Domain\Entity\Movie;

class UpdateMovieCommand
{
    public string $uuid;
    public string $title;
    public bool $active;
    public Movie $movie;

    public function __construct(string $uuid, string $title, bool $active, Movie $movie)
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->active = $active;
        $this->movie = $movie;
    }

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

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}