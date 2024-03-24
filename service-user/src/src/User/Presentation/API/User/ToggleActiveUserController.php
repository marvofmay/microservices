<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\ToggleActiveAction;
use App\User\Domain\Interface\User\UserReaderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class ToggleActiveUserController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly UserReaderInterface $userReaderRepository
    ) {}
    #[Route('/{uuid}/toggle-active', name: 'toggle_active', methods: ['PATCH'])]
    public function toggleActive(string $uuid, ToggleActiveAction $toggleActiveAction): Response
    {
        try {
            $user = $this->userReaderRepository->getUserByUUID($uuid);
            $toggleActiveAction->setUserToggleActive($user)->execute();

            return $this->json([
                'message' => 'Now, user is ' . (! $user->getActive() ? 'not active :( ' : 'active :)')
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user\'s active toggle: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}