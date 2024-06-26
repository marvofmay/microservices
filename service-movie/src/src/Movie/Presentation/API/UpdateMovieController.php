<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Action\UpdateMovieAction;
use App\Movie\Domain\DTO\UpdateMovieDTO;
use App\Movie\Domain\Interfce\Movie\MovieReaderInterface;
use App\Movie\Domain\Service\Movie\ReaderService\CheckTokenService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies', name: 'api.movies.')]
class UpdateMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MovieReaderInterface $movieReaderRepository,
        private readonly CheckTokenService $checkTokenService
    ) {}

    #[Route('/{uuid}', name: 'movies.update', methods: ['PUT'])]
    public function update(string $uuid, UpdateMovieDTO $updateMovieDTO , UpdateMovieAction $updateMovieAction): Response
    {
        try {
            $this->checkTokenService->verifyToken();

            if ($uuid !== $updateMovieDTO->getUUID()) {
                return $this->json(['errors' => 'different movie UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $updateMovieAction->setMovieToUpdate($this->movieReaderRepository->getMovieByUUID($uuid))
                ->execute($updateMovieDTO);

            return $this->json(['data' => 'movie has been updated'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying update movie: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with update movie'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}