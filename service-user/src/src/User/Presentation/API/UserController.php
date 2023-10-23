<?php

namespace App\User\Presentation\API;

use App\User\Application\Query\User\GetUsersQuery;
use App\User\Application\QueryHandler\User\GetUsersQueryHandler;
use App\User\Domain\Action\User\CreateUserAction;
use App\User\Domain\Action\User\DeleteUserAction;
use App\User\Domain\Action\User\RegisterUserAction;
use App\User\Domain\Action\User\UpdateUserAction;
use App\User\Domain\Service\ReaderService\UserReaderService;
use App\User\Presentation\Request\User\ListingRequest;
use App\User\Presentation\Validation\User\Create\CreateValidationRequest;
use App\User\Presentation\Validation\User\Register\RegisterValidationRequest;
use App\User\Presentation\Validation\User\Update\UpdateValidationRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api.')]
class UserController extends AbstractController
{
    private RegisterValidationRequest $registerValidationRequest;
    private RegisterUserAction $registerUserAction;
    private UserReaderService $userReaderService;
    public LoggerInterface $logger;
    public UserPasswordHasherInterface $userPasswordInterface;

    public function __construct(
        RegisterValidationRequest $registerValidationRequest,
        RegisterUserAction $registerUserAction,
        UserReaderService $userReaderService,
        LoggerInterface $logger,
        UserPasswordHasherInterface $userPasswordInterface
    )
    {
        $this->registerValidationRequest = $registerValidationRequest;
        $this->registerUserAction = $registerUserAction;
        $this->userReaderService = $userReaderService;
        $this->logger = $logger;
        $this->userPasswordInterface = $userPasswordInterface;
    }

    #[Route('/users', name: 'users.index', methods: ['GET'])]
    public function index(Request $request, GetUsersQueryHandler $usersQueryHandler): Response
    {
        try {
            return $this->json(['data' => $usersQueryHandler->handle(new GetUsersQuery(new ListingRequest($request)))], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('show users: ' . $e->getMessage());

            return $this->json(['data' => [], 'errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/users/{uuid}', name: 'users.show', methods: ['GET'])]
    public function show(string $uuid): Response
    {
        try {
            return $this->json(
                [
                    'data' => $this->userReaderService->getUserByUUID($uuid),
                    'hasRoleUser' => $this->userReaderService->getUserByUUID($uuid)->hasRole('ROLE_USER'),
                    'hasRoleAdmin' => $this->userReaderService->getUserByUUID($uuid)->hasRole('ROLE_ADMIN'),
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            $this->logger->error('show user by uuid: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/users', name: 'users.store', methods: ['POST'])]
    public function store(CreateValidationRequest $createValidationRequest, CreateUserAction $createUserAction): Response
    {
        try {
            $errorMessages = $createValidationRequest->validate();
            if (count($errorMessages) > 0) {
                return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
            }
            $createUserAction->execute();

            return $this->json(['data' => 'User has been created.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('user created: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/users/{uuid}', name: 'users.update', methods: ['PUT'])]
    public function update(string $uuid, UpdateValidationRequest $updateValidationRequest, UpdateUserAction $updateUserAction): Response
    {
        try {
            if ($uuid !== $updateValidationRequest->getUpdateRequest()->getUUID()) {
                return $this->json(['errors' => 'Different UUID in body raw and url'], Response::HTTP_BAD_REQUEST);
            }
            $errorMessages = $updateValidationRequest->validate();
            if (count($errorMessages) > 0) {
                return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
            }
            $updateUserAction->setUserToUpdate($this->userReaderService->getNotDeletedUserByUUID($uuid))->execute();

            return $this->json(['data' => 'User has been updated.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user updated: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/users/register', name: 'users.register', methods: ['POST'])]
    public function register(): Response
    {
        try {
            $errorMessages = $this->registerValidationRequest->validate();
            if (count($errorMessages) > 0) {
                return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
            }
            $this->registerUserAction->execute();

            return $this->json(['data' => 'User has been registered.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user register: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/users/{uuid}', name: 'users.destroy', methods: ['DELETE'])]
    public function destroy(string $uuid, DeleteUserAction $deleteUserAction): Response
    {
        try {
            $deleteUserAction->setUserToDelete($this->userReaderService->getNotDeletedUserByUUID($uuid))->execute();

            return $this->json(['data' => 'User has been deleted.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $this->logger->error('trying user delete: ' .  $e->getMessage());

            return $this->json(['errors' => 'Upss...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}