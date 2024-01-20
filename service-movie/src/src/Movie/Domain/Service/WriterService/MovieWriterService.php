<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Service\WriterService;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Repository\WriterRepository\MovieWriterRepository;

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

    public function saveMoviesInDB (array $movies, array $categories): void
    {
        $this->movieWriterRepository->saveMoviesInDB($movies, $categories);
    }

    public function updateMovieInDB (Movie $movie, array $categories): void
    {
        $this->movieWriterRepository->updateMovieInDB($movie, $categories);
    }

    public function deleteMovieCategories(Movie $movie): void
    {
        $this->movieWriterRepository->deleteMovieCategories($movie);
    }
}