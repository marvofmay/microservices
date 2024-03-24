<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Action\ToggleActiveAction;
use App\Movie\Domain\Interfce\Movie\MovieReaderInterface;
use App\Movie\Domain\Service\Movie\ReaderService\CheckTokenService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies', name: 'api.movies.')]
class ToggleActiveMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CheckTokenService $checkTokenService,
        private readonly MovieReaderInterface $movieReaderRepository
    ) {}

    #[Route('/{uuid}/toggle-active', name: 'toggle_active', methods: ['PATCH'])]
    public function toggleActive(string $uuid, ToggleActiveAction $toggleActiveAction): Response
    {
        try {
            $this->checkTokenService->verifyToken();
            $movie = $this->movieReaderRepository->getMovieByUUID($uuid, true);
            $toggleActiveAction->setMovieToggleActive($movie)->execute();

            return $this->json(
                [
                    'message' => 'Now, movie is ' . (! $movie->getActive() ? 'not active :( ' : 'active :)')
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying movie\'s active toggle: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with toggle active movie.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}