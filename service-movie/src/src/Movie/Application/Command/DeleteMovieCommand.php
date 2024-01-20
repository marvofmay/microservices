<?php

declare(strict_types = 1);

namespace App\Movie\Application\Command;

use App\Movie\Domain\Entity\Movie;

class DeleteMovieCommand
{
    public function __construct(private readonly Movie $movie)
    {
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}