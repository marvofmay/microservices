<?php

namespace App\Movie\Application\Command;

use App\Movie\Domain\Entity\Movie;

class DeleteMovieCommand
{
    public Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}