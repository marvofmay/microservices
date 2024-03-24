<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Service\Movie\WriterService;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Repository\Movie\WriterRepository\MovieWriterRepository;

class MovieWriterService
{
    public function __construct(private readonly MovieWriterRepository $movieWriterRepository)
    {
    }

    public function __toString()
    {
        return 'MovieWriterService';
    }

    public function saveMovieInDB (Movie $movie): void
    {
        $this->movieWriterRepository->saveMovieInDB($movie);
    }

    public function saveMoviesAndCategoriesInDB (array $movies): void
    {
        $this->movieWriterRepository->saveMoviesAndCategoriesInDB($movies);
    }

    public function updateMovieInDB (Movie $movie): void
    {
        $this->movieWriterRepository->updateMovieInDB($movie);
    }

    public function deleteMovieCategories(Movie $movie): void
    {
        $this->movieWriterRepository->deleteMovieCategories($movie);
    }
}