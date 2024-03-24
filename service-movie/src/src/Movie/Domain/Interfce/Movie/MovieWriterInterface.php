<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Interfce\Movie;

use App\Movie\Domain\Entity\Movie;

interface MovieWriterInterface
{
    public function saveMovieInDB(Movie $movie): void;
    public function saveMoviesAndCategoriesInDB (array $movies): void;
    public function updateMovieInDB(Movie $movie): void;
    public function deleteMovieCategories(Movie $movie): void;
}