<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Repository\Movie\WriterRepository;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieExistsInDBException;
use App\Movie\Domain\Repository\Category\ReaderRepository\CategoryReaderRepository;
use App\Movie\Domain\Repository\Movie\ReaderRepository\MovieReaderRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieWriterRepository extends ServiceEntityRepository
{

    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly MovieReaderRepository $movieReaderRepository,
        private readonly CategoryReaderRepository $categoryReaderRepository
    ) {
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

    public function saveMoviesAndCategoriesInDB(array $movies): void
    {
        $this->getEntityManager()->beginTransaction();
        try {
            foreach ($movies as $movie) {
                if ($this->movieReaderRepository->getMovieByTitle($movie->getTitle())) {
                    throw new MovieExistsInDBException(sprintf('Movie "%s" exists in DB', $movie->getTitle()));
                }
                foreach ($movie->getCategoriesEntities() as $categoryEntity) {
                    $categoryObject = $this->categoryReaderRepository->getCategoryByNme($categoryEntity->getName());
                    if (empty($categoryObject)) {
                        $this->getEntityManager()->persist($categoryEntity);
                        $this->getEntityManager()->flush();
                    } else {
                        $movie->removeCategory($categoryEntity);
                        $movie->addCategory($categoryObject);
                    }
                }
                $this->getEntityManager()->persist($movie);
            }
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();
        } catch (\Exception $e) {
            $this->getEntityManager()->rollback();

            throw $e;
        }
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