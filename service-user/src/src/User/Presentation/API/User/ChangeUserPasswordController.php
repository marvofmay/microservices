<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\ChangeUserPasswordAction;
use App\User\Domain\DTO\User\ChangePasswordDTO;
use App\User\Domain\Interface\User\UserReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class ChangeUserPasswordController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly UserReaderInterface $userReaderRepository
    ) {}
    #[Route('/{uuid}/change-password', name: 'change_password', methods: ['PATCH'])]
    public function changePassword(string $uuid, ChangePasswordDTO $changePasswordDTO, ChangeUserPasswordAction $changeUserPasswordAction): Response
    {
        try {
            $changeUserPasswordAction->setUserToChangePassword(
                $this->userReaderRepository->getNotDeletedUserByUUID($uuid)
            )->execute($changePasswordDTO);

            return $this->json(['message' => 'User\'s password has been changed.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user\'s password change: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss... problem with user\'s password change'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}