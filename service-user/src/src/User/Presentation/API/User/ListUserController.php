<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Application\Query\User\GetUsersQuery;
use App\User\Application\QueryHandler\User\GetUsersQueryHandler;
use App\User\Presentation\Request\User\ListingRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/users', name: 'api.users.')]
class ListUserController extends AbstractController
{
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;
    public SerializerInterface $serializer;

    public function __construct(
        LoggerInterface $logger,
        UserPasswordHasherInterface $userPasswordInterface,
        SerializerInterface $serializer
    )
    {
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
        $this->serializer = $serializer;
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function index(Request $request, GetUsersQueryHandler $usersQueryHandler): Response
    {
        try {
            return $this->json([
                'data' =>
                    json_decode($this->serializer->serialize(
                        $usersQueryHandler->handle(new GetUsersQuery(new ListingRequest($request))),
                        'json', ['groups' => ['user_info']],
                    ))
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('show users: ' . $e->getMessage());

            return $this->json(['data' => [], 'errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}