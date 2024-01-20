<?php

namespace App\Tests\Movie\Unit\DTO;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\DTO\CreateMovieDTO;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class CreateDTOTest extends WebTestCase
{

    private static function requestData(): array
    {
        return [
            'movies' => [
                [
                    Movie::COLUMN_TITLE => 'Movie 1',
                    Movie::COLUMN_ACTIVE => true,
                ],
                [
                    Movie::COLUMN_TITLE => 'Movie 2',
                    Movie::COLUMN_ACTIVE => false,
                ],
            ]
        ];
    }

    public function testGetMoviesFromRequestData(): void
    {
        $requestData = self::requestData();
        $request = new Request([], [], [], [], [], [], json_encode($requestData));
        $createDTO = new CreateMovieDTO($request);

        $this->assertEquals($requestData['movies'], $createDTO->getMovies());
    }

    public function testGetMoviesFromEmptyRequest(): void
    {
        $request = new Request();
        $createDTO = new CreateMovieDTO($request);

        $this->assertNull($createDTO->getMovies());
    }

    public function testGetUniqueTitle() : void
    {
        $data = [
            [Movie::COLUMN_TITLE => 'Pulp Fiction 1', Movie::COLUMN_ACTIVE => true],
            [Movie::COLUMN_TITLE => 'Pulp Fiction 2', Movie::COLUMN_ACTIVE => true],
            [Movie::COLUMN_TITLE => 'Pulp Fiction 1', Movie::COLUMN_ACTIVE => true],
            [Movie::COLUMN_TITLE => 'Pulp Fiction 2', Movie::COLUMN_ACTIVE => true],
            [Movie::COLUMN_TITLE => 'Pulp Fiction 1', Movie::COLUMN_ACTIVE => true],
            [Movie::COLUMN_TITLE => 'Pulp Fiction 3', Movie::COLUMN_ACTIVE => true],
        ];

        $createDTO = new CreateMovieDTO($this->createMock(Request::class));
        $reflection = new \ReflectionClass($createDTO);
        $privateMethodGetUniqueTitleMethod = $reflection->getMethod('getUniqueTitle');
        $privateMethodGetUniqueTitleMethod->setAccessible(true);
        $result = $privateMethodGetUniqueTitleMethod->invoke($createDTO, $data);

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }
}
