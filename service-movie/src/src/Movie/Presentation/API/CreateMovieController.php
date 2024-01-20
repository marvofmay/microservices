<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Action\CreateMovieAction;
use App\Movie\Domain\DTO\CreateMovieDTO;
use App\Movie\Domain\Service\ReaderService\CheckTokenService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies', name: 'api.movies.')]
class CreateMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CheckTokenService $checkTokenService
    ) {}

    #[Route('', name: 'store', methods: ['POST'])]
    public function store(CreateMovieDTO $createMovieDTO, CreateMovieAction $createMovieAction): Response
    {
        try {
            $this->checkTokenService->verifyToken();
            $createMovieAction->execute($createMovieDTO);

            return $this->json(['message' => 'movies has been created'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying create movie: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}