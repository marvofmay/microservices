<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Interfce\Movie;

use App\Movie\Domain\Entity\Movie;

interface MovieWriterInterface
{
    function saveMovieInDB(Movie $movie): void;
    function saveMoviesAndCategoriesInDB (array $movies): void;
    function updateMovieInDB(Movie $movie): void;
    function deleteMovieCategories(Movie $movie): void;
}