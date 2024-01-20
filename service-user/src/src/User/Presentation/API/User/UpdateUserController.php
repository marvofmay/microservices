<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\UpdateUserAction;
use App\User\Domain\DTO\User\UpdateDTO;
use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class UpdateUserController extends AbstractController
{
    private UserReaderService $userReaderService;
    public LoggerInterface $logger;

    public function __construct(
        UserReaderService $userReaderService,
        LoggerInterface           $logger,
    )
    {
        $this->userReaderService = $userReaderService;
        $this->logger = $logger;
    }

    #[Route('/{uuid}', name: 'update', methods: ['PUT'])]
    public function update(string $uuid, UpdateDTO $updateDTO, UpdateUserAction $updateUserAction): Response
    {
        try {
            if ($uuid !== $updateDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $updateUserAction->setUserToUpdate($this->userReaderService->getUserByUUID($uuid))
                ->execute($updateDTO);

            return $this->json(['message' => 'User has been updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user updated: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}