<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\Address;

use App\User\Application\Query\Address\GetAddressesByUserUUIDQuery;
use App\User\Application\QueryHandler\Address\GetAddressesByUserUUIDQueryHandler;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/addresses', name: 'api.addresses.')]
class UserAddressesController extends AbstractController
{
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(
        LoggerInterface $logger,
        UserPasswordHasherInterface $userPasswordInterface
    )
    {
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    #[Route('/users/{uuid}', name: 'users', methods: ['GET'])]
    public function userAddresses(string $uuid, GetAddressesByUserUUIDQueryHandler $getAddressesByUserUUIDQueryHandler): Response
    {
        try {
            return $this->json(['data' => $getAddressesByUserUUIDQueryHandler->handle(new GetAddressesByUserUUIDQuery($uuid))], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('get user addresses: ' . $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}