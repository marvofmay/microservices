<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\UploadUserAvatarAction;
use App\User\Domain\DTO\User\UploadUserAvatarDTO;
use App\User\Domain\Interface\User\UserReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class UploadUserAvatarController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly UserReaderInterface $userReaderRepository
    ) {}

    #[Route('/{uuid}/avatar/upload', name: 'avatar_upload', methods: ['PATCH'])]
    public function store(string $uuid, UploadUserAvatarDTO $uploadUserAvatarDTO, UploadUserAvatarAction $uploadUserAvatarAction): Response {
        try {
            if ($uuid !== $uploadUserAvatarDTO->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }

            $uploadUserAvatarAction->setUser($this->userReaderRepository->getNotDeletedUserByUUID($uuid))
                ->execute($uploadUserAvatarDTO);

            return $this->json(['data' => 'User\'s avatar has been saved.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('user\'s avatar upload error: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with upload user\'s avatar.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}