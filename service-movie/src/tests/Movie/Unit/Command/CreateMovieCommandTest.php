<?php

namespace App\Tests\Movie\Unit\Command;

use PHPUnit\Framework\TestCase;
use App\Movie\Application\Command\CreateMovieCommand;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateMovieCommandTest extends WebTestCase
{

    public function testGetMovies()
    {
        $movies = [
            [
                'title' => 'Movie 1',
                'active' => true,
            ],
            [
                'title' => 'Movie 2',
                'active' => false,
            ],
        ];
        $command = new CreateMovieCommand($movies);

        $this->assertEquals($movies, $command->getMovies());
    }
}