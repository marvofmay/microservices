<?php

declare(strict_types = 1);

namespace App\Movie\Application\Command;

use App\Movie\Domain\Entity\Movie;

class RestoreDeletedMovieCommand
{
    public function __construct(public Movie $movie)
    {
    }
}