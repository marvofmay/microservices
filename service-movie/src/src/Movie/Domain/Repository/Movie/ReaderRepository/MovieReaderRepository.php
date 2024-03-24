<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Repository\Movie\ReaderRepository;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieNotFindByUUIDException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class MovieReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getMovieByTitleAndDifferentUUID(string $title, string $uuid): ?Movie
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.title = :title AND m.uuid <> :uuid')
            ->setParameter('title', $title)
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getMovieByTitle(string $title): ?Movie
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM App\Movie\Domain\Entity\Movie m WHERE m.title = :title')
            ->setParameter('title', $title)
            ->getOneOrNullResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws MovieNotFindByUUIDException
     */
    public function getMovieByUUID(string $uuid, bool $withDeleted = false): ?Movie
    {
        if ($withDeleted) {
            $filters = $this->getEntityManager()->getFilters();
            $filters->disable('softdeleteable');
        }

        $movie = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from(Movie::class, 'm')
            ->where('m.' . Movie::COLUMN_UUID . ' = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult();

        if (! $movie) {
            throw new MovieNotFindByUUIDException('Movie not found by uuid: ' . $uuid);
        }

        return $movie;
    }
}