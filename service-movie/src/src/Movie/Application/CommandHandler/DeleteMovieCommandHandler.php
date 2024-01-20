<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\DeleteMovieCommand;
use Doctrine\ORM\EntityManagerInterface;

class DeleteMovieCommandHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(DeleteMovieCommand $command): void
    {
        $movie = $command->getMovie();
        $movie->setActive(false);
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
        $this->entityManager->remove($movie);
        $this->entityManager->flush();
    }
}