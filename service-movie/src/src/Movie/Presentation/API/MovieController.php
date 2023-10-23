<?php

namespace App\Movie\Presentation\API;

use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Application\QueryHandler\GetMoviesQueryHandler;
use App\Movie\Domain\Action\CreateMovieAction;
use App\Movie\Domain\Action\UpdateMovieAction;
use App\Movie\Domain\DTO\CreateDTO;
use App\Movie\Domain\DTO\ListingDTO;
use App\Movie\Domain\DTO\UpdateDTO;
use App\Movie\Domain\Exception\MovieExistsInDBException;
use App\Movie\Domain\Service\ReaderService\MovieReaderService;
use App\Movie\Presentation\Validation\Create\CreateRequestValidation;
use App\Movie\Domain\Action\DeleteMovieAction;
use App\Movie\Presentation\Validation\Update\UpdateRequestValidation;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api.')]
class MovieController extends AbstractController
{
    private LoggerInterface $logger;
    private MovieReaderService $movieReaderService;

    public function __construct(LoggerInterface $logger, MovieReaderService $movieReaderService)
    {
        $this->logger = $logger;
        $this->movieReaderService = $movieReaderService;
    }

    #[Route('/movies', name: 'movies.index', methods: ['GET'])]
    public function index(Request $request, GetMoviesQueryHandler $getMoviesQueryHandler, SerializerInterface $serializer): Response
    {
        try {
            return $this->json([
                'data' => $this->movieReaderService->transformMoviesEntityToArray(
                    $serializer,
                    $getMoviesQueryHandler->handle(new GetMoviesQuery(new ListingDTO($request)))
                )
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying show movies: ' . $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/movies/{uuid}', name: 'movies.show', methods: ['GET'])]
    public function show(string $uuid, SerializerInterface $serializer): Response
    {
        try {
            return $this->json([
                    'data' => $this->movieReaderService->transformMovieEntityToArray(
                        $serializer,
                        $this->movieReaderService->getNotDeletedMovieByUUID($uuid)
                    )
                ], Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying show movie by uuid: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/movies', name: 'movie.store', methods: ['POST'])]
    public function store(Request $request, CreateRequestValidation $createRequestValidation, CreateMovieAction $createMovieAction): Response
    {
        try {
            $createDTO = new CreateDTO($request);
            $errorsMessages = $createRequestValidation->setCreateDTO($createDTO)->validate();
            if (count($errorsMessages) > 0) {
                return $this->json(['errors' => $errorsMessages], Response::HTTP_BAD_REQUEST);
            }
            $createMovieAction->setCreateDTO($createDTO)->execute();

            return $this->json(['data' => 'movies has been created'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying create movie: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/movies/{uuid}', name: 'movies.update', methods: ['PUT'])]
    public function update(string $uuid, Request $request, UpdateRequestValidation $updateRequestValidation, UpdateMovieAction $updateMovieAction): Response
    {
        try {
            $updateDTO = new UpdateDTO($request);
            if ($uuid !== $updateDTO->getUUID()) {
                return $this->json(['errors' => 'different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }
            $errorsMessages = $updateRequestValidation->setUpdateDTO($updateDTO)->validate();
            if (count($errorsMessages) > 0) {
                return $this->json(['errors' => $errorsMessages], Response::HTTP_BAD_REQUEST);
            }
            $updateMovieAction->setUpdateDTO($updateDTO)
                ->setMovieToUpdate($this->movieReaderService->getNotDeletedMovieByUUID($uuid))
                ->execute();

            return $this->json(['data' => 'movie has been updated'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying update movie: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/movies/{uuid}', name: 'movie.destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteMovieAction $deleteMovieAction): Response
    {
        try {
            $deleteMovieAction->setMovieToDelete($this->movieReaderService->getNotDeletedMovieByUUID($uuid))->execute();

            return $this->json(['data' => 'movie has been deleted'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying delete movie: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}