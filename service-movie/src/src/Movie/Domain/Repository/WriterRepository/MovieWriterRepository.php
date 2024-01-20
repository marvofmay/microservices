<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Repository\WriterRepository;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieExistsInDBException;
use App\Movie\Domain\Repository\ReaderRepository\MovieReaderRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieWriterRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry, private readonly MovieReaderRepository $movieReaderRepository)
    {
        parent::__construct($registry, Movie::class);
    }

    public function saveMovieInDB(Movie $movie): void
    {
        if ($this->movieReaderRepository->getMovieByTitleAndDifferentUUID(
            $movie->getTitle(),
            $movie->getUuid()->toString()
        )) {
            throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
        }
        $this->getEntityManager()->persist($movie);
        $this->getEntityManager()->flush();
    }

    public function saveMoviesInDB(array $movies, array $categories): void
    {
            foreach ($movies as $movie) {
                if ($this->movieReaderRepository->getMovieByTitle($movie->getTitle())) {
                    throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
                }
                $this->getEntityManager()->persist($movie);

            }
            foreach ($categories as $category) {
                $this->getEntityManager()->persist($category);
            }
            $this->getEntityManager()->flush();
    }

    public function updateMovieInDB(Movie $movie, array $categories): void
    {
        $this->setMovieCategories($movie, $categories);

        if ($this->movieReaderRepository->getMovieByTitleAndDifferentUUID($movie->getTitle(), $movie->getUuid()->toString())) {
            throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
        }
        $this->getEntityManager()->persist($movie);
        $this->getEntityManager()->flush();
    }

    public function setMovieCategories(Movie $movie, array $categories): void
    {
        foreach ($categories as $categoryObject) {
            $categoryObject->setMovie($movie);
            $this->getEntityManager()->persist($categoryObject);
        }
    }

    public function deleteMovieCategories(Movie $movie): void
    {
        $categoriesToRemove = $movie->getCategoriesEntities();
        foreach ($categoriesToRemove as $categoryToRemove) {
            $this->getEntityManager()->remove($categoryToRemove);
        }
    }
}