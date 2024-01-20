<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\CreateUserAction;
use App\User\Domain\DTO\User\CreateDTO;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class CreateUserController extends AbstractController
{
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(
        LoggerInterface $logger,
        UserPasswordHasherInterface $userPasswordInterface
    )
    {
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    #[Route('', name: 'store', methods: ['POST'])]
    public function store(CreateDTO $createDTO, CreateUserAction $createUserAction): Response
    {
        try {
            $createUserAction->execute($createDTO);

            return $this->json(['message' => 'User has been created.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('user created: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}