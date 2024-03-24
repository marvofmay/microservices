<?php

namespace App\Tests\Movie\Unit\CommandHandler;

use App\Movie\Application\Command\DeleteMovieCommand;
use App\Movie\Application\CommandHandler\DeleteMovieCommandHandler;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Service\Movie\WriterService\MovieWriterService;
use PHPUnit\Framework\TestCase;

class DeleteMovieCommandHandlerTest extends TestCase
{

    public function testHandleDeleteMovieCommand(): void
    {
        $movie = $this->createMock(Movie::class);
        $movieWriterService = $this->createMock(MovieWriterService::class);
        $movieWriterService->expects($this->once())
            ->method('saveMovieInDB');

        $handler = new DeleteMovieCommandHandler($movieWriterService);
        $deleteMovieCommand = new DeleteMovieCommand($movie);
        $handler($deleteMovieCommand);

        $this->assertInstanceOf(DeleteMovieCommand::class, $deleteMovieCommand);
        $this->assertTrue(method_exists($handler, '__invoke'));
    }
}
