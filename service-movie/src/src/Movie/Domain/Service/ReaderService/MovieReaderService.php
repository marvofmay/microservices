<?php

namespace App\Movie\Domain\Service\ReaderService;

use App\Movie\Domain\Entity\Movie;
use App\Movie\Domain\Repository\ReaderRepository\MovieReaderRepository;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
use Symfony\Component\Serializer\SerializerInterface;

class MovieReaderService
{
    private MovieReaderRepository $movieReaderRepository;
    public function __construct(MovieReaderRepository $movieReaderRepository)
    {
        $this->movieReaderRepository = $movieReaderRepository;
    }

    public function getMovieByUUID(string $uuid): ?Movie
    {
        return $this->movieReaderRepository->getMovieByUUID($uuid);
    }

    public function getNotDeletedMovieByUUID(string $uuid): ?Movie
    {
        return $this->movieReaderRepository->getNotDeletedMovieByUUID($uuid);
    }

    public function transformMovieEntityToArray(SerializerInterface $serializer, Movie $movie): array
    {
        $context = (new ObjectNormalizerContextBuilder())
            ->withGroups('movie_entity_serialization')
            ->toArray();

        return $serializer->normalize($movie, 'array', $context);
    }

    public function transformMoviesEntityToArray(SerializerInterface $serializer, array $movies): array
    {
        $data = [];
        foreach ($movies as $movie) {
            $data[] = $this->transformMovieEntityToArray($serializer, $movie);
        }

        return $data;
    }
}