<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\UpdateUserAction;
use App\User\Domain\DTO\User\UpdateDTO;
use App\User\Domain\Interface\User\UserReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class UpdateUserController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly UserReaderInterface $userReaderRepository
    ) {}

    #[Route('/{uuid}', name: 'update', methods: ['PUT'])]
    public function update(string $uuid, UpdateDTO $updateDTO, UpdateUserAction $updateUserAction): Response
    {
        try {
            if ($uuid !== $updateDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }
            $updateUserAction->setUserToUpdate($this->userReaderRepository->getUserByUUID($uuid))
                ->execute($updateDTO);

            return $this->json(['message' => 'User has been updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user updated: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with update user.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}