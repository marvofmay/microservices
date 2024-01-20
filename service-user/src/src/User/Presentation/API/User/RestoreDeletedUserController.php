<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\RestoreDeleteAction;
use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class RestoreDeletedUserController extends AbstractController
{
    private UserReaderService $userReaderService;
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(
        UserReaderService   $userReaderService,
        LoggerInterface             $logger,
        UserPasswordHasherInterface $userPasswordInterface
    )
    {
        $this->userReaderService = $userReaderService;
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    #[Route('/{uuid}/restore-deleted', name: 'restore_deleted', methods: ['PATCH'])]
    public function restoreDeleted(string $uuid, RestoreDeleteAction $restoreDeleteAction): Response
    {
        try {
            $restoreDeleteAction->setUserToRestore($this->userReaderService->getUserByUUID($uuid))->execute();

            return $this->json(['message' => 'User has been restored.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user restore: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}