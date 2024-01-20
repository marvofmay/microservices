<?php

declare(strict_types = 1);

namespace App\User\Presentation\API\User;

use App\User\Domain\Action\User\RegisterUserAction;
use App\User\Domain\DTO\User\RegisterDTO;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users', name: 'api.users.')]
class RegisterUserController extends AbstractController
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
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(RegisterDTO $registerDTO, RegisterUserAction $registerUserAction): Response
    {
        try {
            $registerUserAction->execute($registerDTO);

            return $this->json(['data' => 'User has been registered.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user register: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}