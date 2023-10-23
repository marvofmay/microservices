<?php

namespace App\Movie\Domain\Repository\WriterRepository;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieExistsInDBException;
use App\Movie\Domain\Repository\ReaderRepository\MovieReaderRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieWriterRepository extends ServiceEntityRepository
{
    private MovieReaderRepository $movieReaderRepository;

    public function __construct(ManagerRegistry $registry, MovieReaderRepository $movieReaderRepository)
    {
        parent::__construct($registry, Movie::class);
        $this->movieReaderRepository = $movieReaderRepository;
    }

    public function saveMovieInDB(Movie $movie): void
    {
        if ($this->movieReaderRepository->getMovieByTitleAndDifferentUUID($movie->getTitle(), $movie->getUuid())) {
            throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
        }
        $this->getEntityManager()->persist($movie);
        $this->getEntityManager()->flush();
    }

    public function saveMoviesInDB(array $movies): void
    {
            foreach ($movies as $movie) {
                if ($this->movieReaderRepository->getMovieByTitle($movie->getTitle())) {
                    throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
                }
                $this->getEntityManager()->persist($movie);
            }
            $this->getEntityManager()->flush();
    }
}