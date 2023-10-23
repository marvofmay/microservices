<?php

namespace App\Movie\Domain\Service\WriterService;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Repository\WriterRepository\MovieWriterRepository;

class MovieWriterService
{
    private MovieWriterRepository $movieWriterRepository;

    public function __construct(MovieWriterRepository $movieWriterRepository)
    {
        $this->movieWriterRepository = $movieWriterRepository;
    }

    public function __toString()
    {
        return 'MovieWriterService';
    }

    public function saveMovieInDB (Movie $movie): void
    {
        $this->movieWriterRepository->saveMovieInDB($movie);
    }

    public function saveMoviesInDB (array $movies): void
    {
        $this->movieWriterRepository->saveMoviesInDB($movies);
    }
}