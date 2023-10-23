<?php

namespace App\Tests\Movie\Unit\Command;

use App\Movie\Application\Command\UpdateMovieCommand;
use App\Movie\Domain\Entity\Movie;
use PHPUnit\Framework\TestCase;

class UpdateMovieCommandTest extends TestCase
{
    public function testUpdateMovieCommand()
    {
        $uuid = 'some-uuid';
        $title = 'Updated Movie Title';
        $active = false;
        $movie = new Movie();

        $command = new UpdateMovieCommand($uuid, $title, $active, $movie);

        $this->assertEquals($uuid, $command->getUUID());
        $this->assertEquals($title, $command->getTitle());
        $this->assertEquals($active, $command->getActive());
        $this->assertSame($movie, $command->getMovie());
    }
}