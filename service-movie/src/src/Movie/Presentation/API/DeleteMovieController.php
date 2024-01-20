<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Service\ReaderService\CheckTokenService;
use App\Movie\Domain\Service\ReaderService\MovieReaderService;
use App\Movie\Domain\Action\DeleteMovieAction;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies', name: 'api.movies.')]
class DeleteMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MovieReaderService $movieReaderService,
        private readonly CheckTokenService $checkTokenService
    ) {}

    #[Route('/{uuid}', name: 'movie.destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteMovieAction $deleteMovieAction): Response
    {
        try {
            $this->checkTokenService->verifyToken();
            $deleteMovieAction->setMovieToDelete($this->movieReaderService->getMovieByUUID($uuid))
                ->execute();

            return $this->json(['message' => 'movie has been deleted'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying delete movie: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}