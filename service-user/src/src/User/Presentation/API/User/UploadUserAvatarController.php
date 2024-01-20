<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\UploadUserAvatarAction;
use App\User\Domain\DTO\User\UploadUserAvatarDTO;
use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class UploadUserAvatarController extends AbstractController
{
    private LoggerInterface $logger;
    private UserReaderService $userReaderService;

    public function __construct(
        LoggerInterface $logger,
        UserReaderService $userReaderService
    ) {
        $this->logger = $logger;
        $this->userReaderService = $userReaderService;
    }

    #[Route('/{uuid}/avatar/upload', name: 'avatar_upload', methods: ['PATCH'])]
    public function store(
        string $uuid,
        UploadUserAvatarDTO $uploadUserAvatarDTO,
        UploadUserAvatarAction $uploadUserAvatarAction
    ): Response
    {
        try {
            if ($uuid !== $uploadUserAvatarDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $uploadUserAvatarAction->setUser($this->userReaderService->getNotDeletedUserByUUID($uuid))
                ->execute($uploadUserAvatarDTO);

            return $this->json(['data' => 'User\'s avatar has been saved.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('user\'s avatar upload error: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}