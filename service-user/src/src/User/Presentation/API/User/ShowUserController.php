<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/users', name: 'api.users.')]
class ShowUserController extends AbstractController
{
    private UserReaderService $userReaderService;
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;
    public SerializerInterface $serializer;

    public function __construct(
        UserReaderService   $userReaderService,
        LoggerInterface             $logger,
        UserPasswordHasherInterface $userPasswordInterface,
        SerializerInterface         $serializer
    )
    {
        $this->userReaderService = $userReaderService;
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
        $this->serializer = $serializer;
    }

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

            return $this->json(['errors' => $e->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}