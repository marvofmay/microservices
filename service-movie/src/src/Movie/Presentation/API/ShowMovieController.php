<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Domain\Interfce\Movie\MovieReaderInterface;
use App\Movie\Domain\Service\Movie\ReaderService\CheckTokenService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/movies', name: 'api.show.')]
class ShowMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly MovieReaderInterface $movieReaderRepository,
        private readonly CheckTokenService $checkTokenService,
        private readonly SerializerInterface $serializer
    ) {}

    #[Route('/{uuid}', name: 'movies.show', methods: ['GET'])]
    public function show(string $uuid): Response
    {
        try {
            $this->checkTokenService->verifyToken();

            return $this->json([
                'data' =>
                    json_decode($this->serializer->serialize(
                        $this->movieReaderRepository->getMovieByUUID($uuid, true),
                        'json',
                        ['groups' => ['movie_info']],
                    ))
                ], Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying show movie by uuid: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... Problem with show movie.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}