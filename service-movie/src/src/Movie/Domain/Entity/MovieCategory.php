<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Entity;

use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(
    name: "movie_category",
)]
class MovieCategory
{
    public const MOVIE_CATEGORY_TABLE_NAME = 'movie_category';
    public const COLUMN_MOVIE_UUID = 'movie_uuid';
    public const COLUMN_CATEGORY_UUID = 'category_uuid';

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private UuidInterface $movie_uuid;

    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    private UuidInterface $category_uuid;
}