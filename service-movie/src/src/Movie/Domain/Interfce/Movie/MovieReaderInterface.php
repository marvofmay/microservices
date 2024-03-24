<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Interfce\Movie;

use App\Movie\Domain\Entity\Movie;

interface MovieReaderInterface
{
    public function getMovieByTitleAndDifferentUUID(string $title, string $uuid): ?Movie;
    public function getMovieByTitle(string $title): ?Movie;
    public function getMovieByUUID(string $uuid, bool $withDeleted = false): ?Movie;
}