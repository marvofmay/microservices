<?php

namespace App\Tests\Movie\Unit\Command;

use App\Movie\Application\Command\DeleteMovieCommand;
use App\Movie\Domain\Entity\Movie;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeleteMovieCommandTest extends WebTestCase
{
    public function testConstructorAndGetMovie()
    {
        $movie = new Movie();
        $command = new DeleteMovieCommand($movie);

        $this->assertSame($movie, $command->getMovie());
    }
}