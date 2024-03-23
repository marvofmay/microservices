<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/users', name: 'api.users.')]
class ShowUserController extends AbstractController
{
    public function __construct(
        private readonly UserReaderService $userReaderService,
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer
    ) {}

    #[Route('/{uuid}', name: 'show', methods: ['GET'])]
    public function show(string $uuid): Response
    {
        try {
            return $this->json(
                [
                    'data' =>
                        json_decode($this->serializer->serialize(
                            $this->userReaderService->getUserByUUID($uuid),
                            'json', ['groups' => ['user_info']],
                        ))
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('show user by uuid: ' . $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with show user data'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}