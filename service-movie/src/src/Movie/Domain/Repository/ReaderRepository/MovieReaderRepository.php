<?php

namespace App\Movie\Domain\Repository\ReaderRepository;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieNotFindByUUIDException;
use App\Movie\Domain\Exception\MoviesNotExistsException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function getMovieByTitleAndDifferentUUID(string $title, string $uuid): ?Movie
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.title = :title AND m.uuid <> :uuid')
            ->setParameter('title', $title)
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();
    }

    public function getMovieByTitle(string $title): ?Movie
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.title = :title')
            ->setParameter('title', $title)
            ->getOneOrNullResult();
    }

    public function getMovieByUUID(string $uuid): ?Movie
    {
        $movie = $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();

        if (!$movie) {
            throw new MovieNotFindByUUIDException('Movie not found by uuid: ' . $uuid);
        }

        return $movie;
    }

    public function getNotDeletedMovieByUUID(string $uuid): ?Movie
    {
        $movie = $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.uuid = :uuid and m.deletedAt IS NULL')
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();

        if (!$movie) {
            throw new MovieNotFindByUUIDException('Movie not found by uuid: ' . $uuid);
        }

        return $movie;
    }

    public function getMovies(): array
    {
        $movies = $this->getEntityManager()
            ->createQuery('SELECT u FROM App\User\Domain\Entity\User u ORDER BY u.createdAt')
            ->getResult();

        if (!$movies) {
            throw new MoviesNotExistsException('Movies not exists.');
        }

        return $movies;
    }
}