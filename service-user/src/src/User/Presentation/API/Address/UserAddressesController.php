<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\Address;

use App\User\Application\Query\Address\GetAddressesByUserUUIDQuery;
use App\User\Application\QueryHandler\Address\GetAddressesByUserUUIDQueryHandler;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/addresses', name: 'api.addresses.')]
class UserAddressesController extends AbstractController
{
    public function __construct(private readonly LoggerInterface $logger) {}

    #[Route('/users/{uuid}', name: 'users', methods: ['GET'])]
    public function userAddresses(string $uuid, GetAddressesByUserUUIDQueryHandler $getAddressesByUserUUIDQueryHandler): Response
    {
        try {
            return $this->json(['data' => $getAddressesByUserUUIDQueryHandler->handle(new GetAddressesByUserUUIDQuery($uuid))], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('get user addresses: ' . $e->getMessage());

            return $this->json(['errors' => 'Upss.. problem with get user\'s addresses.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}