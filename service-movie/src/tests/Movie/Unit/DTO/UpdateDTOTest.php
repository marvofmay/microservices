<?php

namespace App\Tests\Movie\Unit\DTO;

use App\Movie\Domain\DTO\UpdateDTO;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class UpdateDTOTest extends WebTestCase
{
    private static function requestData(): array
    {
        return [
            'uuid' => '12345-67890',
            'title' => 'Updated Movie',
            'active' => true,
        ];
    }

    public function testDTODataFromRequestData(): void
    {

        $requestData = self::requestData();
        $request = new Request([], [], [], [], [], [], json_encode($requestData));
        $updateDTO = new UpdateDTO($request);

        $this->assertEquals($requestData['uuid'], $updateDTO->getUuid());
        $this->assertEquals($requestData['title'], $updateDTO->getTitle());
        $this->assertEquals($requestData['active'], $updateDTO->getActive());
    }

    public function testGetTitleFromEmptyRequest(): void
    {
        $request = new Request();
        $updateDTO = new UpdateDTO($request);

        $this->assertNull($updateDTO->getTitle());
    }

}