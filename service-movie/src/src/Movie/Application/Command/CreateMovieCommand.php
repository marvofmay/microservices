<?php

namespace App\Movie\Application\Command;

class CreateMovieCommand
{
    public function __construct(public readonly array $movies) {}

    public function getMovies(): array
    {
        return $this->movies;
    }
}