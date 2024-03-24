<?php

namespace App\Tests\Movie\Unit\CommandHandler;

use App\Movie\Application\Command\CreateMovieCommand;
use App\Movie\Application\CommandHandler\CreateMovieCommandHandler;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Service\Movie\WriterService\MovieWriterService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateMovieCommandHandlerTest extends WebTestCase
{
    private static function moviesData(): array
    {
        return [
            [
                Movie::COLUMN_TITLE => 'Movie 1',
                Movie::COLUMN_ACTIVE => true,
            ],
            [
                Movie::COLUMN_TITLE => 'Movie 2',
                Movie::COLUMN_ACTIVE => false,
            ],
        ];
    }

    public function testCreateMovieCommandHandler()
    {
        $movieWriterService = $this->createMock(MovieWriterService::class);
        $movieWriterService->expects($this->once())
            ->method('saveMoviesInDB');

        $handler = new CreateMovieCommandHandler($movieWriterService);
        $createMovieCommand = new CreateMovieCommand(CreateMovieCommandHandlerTest::moviesData());
        $handler($createMovieCommand);

        $this->assertInstanceOf(CreateMovieCommand::class, $createMovieCommand);
        $this->assertTrue(method_exists($handler, '__invoke'));
    }
}