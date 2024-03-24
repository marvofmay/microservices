<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Service\Movie\ReaderService;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Exception\MovieNotFindByUUIDException;
use App\Movie\Domain\Repository\Movie\ReaderRepository\MovieReaderRepository;
use Doctrine\ORM\NonUniqueResultException;

class MovieReaderService
{
    public function __construct(private readonly MovieReaderRepository $movieReaderRepository)
    {
    }

    /**
     * @throws NonUniqueResultException
     * @throws MovieNotFindByUUIDException
     */
    public function getMovieByUUID(string $uuid, bool $withDeleted = false): ?Movie
    {
        return $this->movieReaderRepository->getMovieByUUID($uuid, $withDeleted);
    }
}