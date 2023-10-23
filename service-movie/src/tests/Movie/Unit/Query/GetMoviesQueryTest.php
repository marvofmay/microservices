<?php

namespace App\Tests\Movie\Unit\Query;

use PHPUnit\Framework\TestCase;
use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Domain\DTO\ListingDTO;
use App\Movie\Domain\Entity\Movie;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class GetMoviesQueryTest extends TestCase
{
    public function testConstructorWithListingDTO()
    {
        $requestData = [
            'algorithm' => 1,
            'limit' => 20,
            'page' => 2,
            'sort' => '-title',
            'title' => 'Django',
        ];

        $request = $this->createMock(Request::class);
        $request->query = new ParameterBag($requestData);
        $listingDTO = new ListingDTO($request);
        $query = new GetMoviesQuery($listingDTO);

        $this->assertEquals(1, $query->getAlgorithm());
        $this->assertEquals(20, $query->getLimit());
        $this->assertEquals(2, $query->getPage());
        $this->assertEquals(Movie::COLUMN_TITLE, $query->getOrderBy());
        $this->assertEquals('DESC', $query->getOrderDirection());
        $this->assertEquals(['title' => 'Django'], $query->getFilters());
    }

    public function testConstructorWithEmptyListingDTO()
    {
        $request = $this->createMock(Request::class);
        $request->query = new ParameterBag([]);
        $listingDTO = new ListingDTO($request);
        $query = new GetMoviesQuery($listingDTO);

        $this->assertNull($query->getAlgorithm());
        $this->assertEquals(10, $query->getLimit());
        $this->assertEquals(1, $query->getPage());
        $this->assertEquals(Movie::COLUMN_CREATED_AT, $query->getOrderBy());
        $this->assertEquals('DESC', $query->getOrderDirection());
        $this->assertEmpty($query->getFilters());
    }
}