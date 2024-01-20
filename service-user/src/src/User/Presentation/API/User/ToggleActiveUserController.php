<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\ToggleActiveAction;
use App\User\Domain\Service\User\ReaderService\UserReaderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class ToggleActiveUserController extends AbstractController
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
    #[Route('/{uuid}/toggle-active', name: 'toggle_active', methods: ['PATCH'])]
    public function toggleActive(string $uuid, ToggleActiveAction $toggleActiveAction): Response
    {
        try {
            $user = $this->userReaderService->getUserByUUID($uuid);
            $toggleActiveAction->setUserToggleActive($user)->execute();

            return $this->json(
                [
                    'message' => 'Now, user is ' . (! $user->getActive() ? 'not active :( ' : 'active :)')
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('trying user\'s active toggle: ' .  $e->getMessage());

            return $this->json(['errors' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}