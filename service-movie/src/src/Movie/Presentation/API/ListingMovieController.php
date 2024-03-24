<?php

declare(strict_types = 1);

namespace App\Movie\Presentation\API;

use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Application\QueryHandler\GetMoviesQueryHandlerFactory;
use App\Movie\Domain\DTO\ListingMovieDTO;
use App\Movie\Domain\Service\Movie\ReaderService\CheckTokenService;
use App\Movie\Presentation\Request\ListingMovieRequest;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/movies', name: 'api.movies.')]
class ListingMovieController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer,
        private readonly CheckTokenService $checkTokenService
    ) {}

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ListingMovieDTO $listingMovieDTO, EntityManagerInterface $entityManager): Response
    {
        try {
            $this->checkTokenService->verifyToken();

            $results = GetMoviesQueryHandlerFactory::build(
                new GetMoviesQuery(new ListingMovieRequest($listingMovieDTO)),
                $entityManager
            )->handle();

            return $this->json([
                'data' =>
                    json_decode($this->serializer->serialize(
                        $results,
                        'json',
                        ['groups' => ['movie_info']],
                    ))
            ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying show movies: ' . $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}