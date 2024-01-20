<?php

namespace App\Movie\Application\CommandHandler;

use App\Movie\Application\Command\UpdateMovieCommand;
use App\Movie\Domain\Entity\Category;
use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Service\WriterService\MovieWriterService;

class UpdateMovieCommandHandler
{
    public function __construct(
        private readonly MovieWriterService $movieWriterService,
        private Movie $movie,
        private array $categories = []
    ) {}

    public function __invoke(UpdateMovieCommand $command): void
    {
        $this->setMovie($command);
        $this->setCategories($this->movie, $command);
        $this->movieWriterService->deleteMovieCategories($this->movie);
        $this->movieWriterService->updateMovieInDB($this->movie, $this->categories);
    }

    private function setMovie(UpdateMovieCommand $command): void
    {
        $this->movie = $command->getMovie();
        $this->movie->setTitle($command->getTitle());
        $this->movie->setActive($command->getActive());
    }

    private function setCategories(Movie $movie, UpdateMovieCommand $command): void
    {
        foreach ($command->getCategories() as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $category->setMovie($movie);
            $this->categories[] = $category;
        }
    }
}