<?php

namespace App\Tests\Movie\Unit\CommandHandler;

use PHPUnit\Framework\TestCase;
use App\Movie\Application\CommandHandler\UpdateMovieCommandHandler;
use App\Movie\Application\Command\UpdateMovieCommand;
use App\Movie\Domain\Service\WriterService\MovieWriterService;
use App\Movie\Domain\Entity\Movie;
use Ramsey\Uuid\Uuid;

class UpdateMovieCommandHandlerTest extends TestCase
{
    public function testHandleUpdateMovieCommand()
    {
        $uuid = Uuid::uuid4();

        $movie = new Movie();
        $movie->setUUID($uuid);
        $movie->setTitle('old-title-movie-to-update');
        $movie->setActive(false);

        $updateMovieCommand = $this->createMock(UpdateMovieCommand::class);
        $updateMovieCommand->expects($this->once())
            ->method('getTitle')
            ->willReturn('new-title-movie-to-update');
        $updateMovieCommand->expects($this->once())
            ->method('getActive')
            ->willReturn(true);
        $updateMovieCommand->expects($this->once())
            ->method('getMovie')
            ->willReturn($movie);

        $movieWriterService = $this->createMock(MovieWriterService::class);
        $movieWriterService->expects($this->once())
            ->method('saveMovieInDB')
            ->with($this->callback(function ($arg) use ($uuid) {
                return $arg instanceof Movie
                    && $arg->getUuid() === $uuid
                    && $arg->getTitle() === 'new-title-movie-to-update'
                    && $arg->getActive() === true;
            }));

        $updateMovieCommandHandler = new UpdateMovieCommandHandler($movieWriterService);
        $updateMovieCommandHandler($updateMovieCommand);

        $this->assertInstanceOf(UpdateMovieCommand::class, $updateMovieCommand);
        $this->assertTrue(method_exists($updateMovieCommandHandler, '__invoke'));
    }
}