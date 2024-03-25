<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Interfce\Movie;

use App\Movie\Domain\Entity\Movie;

interface MovieReaderInterface
{
    function getMovieByTitleAndDifferentUUID(string $title, string $uuid): ?Movie;
    function getMovieByTitle(string $title): ?Movie;
    function getMovieByUUID(string $uuid, bool $withDeleted = false): ?Movie;
}