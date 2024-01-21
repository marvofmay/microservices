<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\DeleteUserAction;
use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class DeleteUserController extends AbstractController
{
    public LoggerInterface $logger;
    public UserReaderService $userReaderService;

    public function __construct(LoggerInterface $logger, UserReaderService $userReaderService)
    {
        $this->userReaderService = $userReaderService;
        $this->logger = $logger;
    }

    #[Route('/{uuid}', name: 'destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteUserAction $deleteUserAction): Response
    {
        try {
            $deleteUserAction->setUserToDelete($this->userReaderService->getNotDeletedUserByUUID($uuid))
                ->execute();

            return $this->json(['message' => 'User has been deleted.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user delete: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}