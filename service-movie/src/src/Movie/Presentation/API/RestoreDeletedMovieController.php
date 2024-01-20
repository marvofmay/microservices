<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Action\RestoreDeleteAction;
use App\Movie\Domain\Service\ReaderService\CheckTokenService;
use App\Movie\Domain\Service\ReaderService\MovieReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies', name: 'api.movies.')]
class RestoreDeletedMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CheckTokenService $checkTokenService,
        private readonly MovieReaderService $movieReaderService
    ) {}

    #[Route('/{uuid}/restore-deleted', name: 'restore_deleted', methods: ['PATCH'])]
    public function restoreDeleted(string $uuid, RestoreDeleteAction $restoreDeleteAction): Response
    {
        try {
            $this->checkTokenService->verifyToken();
            $restoreDeleteAction->setMovieToRestore($this->movieReaderService->getMovieByUUID($uuid, true))->execute();

            return $this->json(['message' => 'Movie has been restored.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user restore: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}