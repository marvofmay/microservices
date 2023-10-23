<?php

namespace App\Tests\Movie\Unit\Entity;

use App\Movie\Domain\Entity\Movie;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieEntityTest extends WebTestCase
{
    private const TITLE = 'some title';
    private const ACTIVE = true;
    private const CREATED_AT = '2023-10-15 00:33:00';
    private const UPDATED_AT = '2023-10-15 00:34:00';
    private const DELETED_AT = '2023-10-15 00:35:00';

    private function getMovieObject(): Movie
    {
        $movie = new Movie();
        $movie->setUUID(Uuid::uuid4());
        $movie->setTitle('some title');
        $movie->setActive(true);
        $movie->setCreatedAt(new \DateTime(self::CREATED_AT));
        $movie->setUpdatedAt(new \DateTime(self::UPDATED_AT));
        $movie->setDeletedAt(new \DateTime(self::DELETED_AT));

        return $movie;
    }
    public function testEntityInstance(): void
    {
        $this->assertInstanceOf(Movie::class, $this->getMovieObject());
    }

    public function testGetMethods(): void
    {
        $movie = $this->getMovieObject();
        $this->assertInstanceOf(UuidInterface::class, $movie->getUuid());
        $this->assertEquals(self::TITLE, $movie->getTitle());
        $this->assertEquals(self::ACTIVE, $movie->getActive());
        $this->assertEquals(self::CREATED_AT, $movie->getCreatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals(self::UPDATED_AT, $movie->getUpdatedAt()->format('Y-m-d H:i:s'));
        $this->assertEquals(self::DELETED_AT, $movie->getDeletedAt()->format('Y-m-d H:i:s'));
    }
}