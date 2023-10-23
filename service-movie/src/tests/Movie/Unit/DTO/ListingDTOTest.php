<?php

namespace App\Tests\Movie\Unit\DTO;

use App\Movie\Domain\DTO\ListingDTO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ListingDTOTest extends TestCase
{
    public function testConstructorWithValidRequest()
    {
        $requestData = [
            'algorithm' => 1,
            'limit' => 10,
            'page' => 2,
            'sort' => '-title',
            'title' => 'John Wick',
        ];

        $request = Request::create('', 'GET', $requestData);
        $listingDTO = new ListingDTO($request);

        $this->assertEquals(1, $listingDTO->getAlgorithm());
        $this->assertEquals(10, $listingDTO->getLimit());
        $this->assertEquals(2, $listingDTO->getPage());
        $this->assertEquals('title', $listingDTO->getOrderBy());
        $this->assertEquals(['title' => 'John Wick'], $listingDTO->getFilters());
    }

    public function testConstructorWithEmptyRequest()
    {
        $request = new Request();

        $listingDTO = new ListingDTO($request);

        $this->assertNull($listingDTO->getAlgorithm());
        $this->assertNull($listingDTO->getLimit());
        $this->assertNull($listingDTO->getPage());
        $this->assertNull($listingDTO->getOrderBy());
        $this->assertNull($listingDTO->getOrderDirection());
        $this->assertEquals([], $listingDTO->getFilters());
    }

    public function testConstructorWithInvalidSort()
    {
        $requestData = [
            'algorithm' => 2,
            'sort' => '-invalidSort',
        ];

        $request = Request::create('', 'GET', $requestData);
        $listingDTO = new ListingDTO($request);

        $this->assertEquals(2, $listingDTO->getAlgorithm());
        $this->assertEquals('invalidSort', $listingDTO->getOrderBy());
        $this->assertEquals('DESC', $listingDTO->getOrderDirection());
        $this->assertEquals([], $listingDTO->getFilters());
    }
}
