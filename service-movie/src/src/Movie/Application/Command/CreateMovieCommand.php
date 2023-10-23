<?php

namespace App\Movie\Application\Command;

class CreateMovieCommand
{
    public array $movies;

    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }
}