<?php

namespace App\User\Domain\Service\WriterService;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\WriterRepository\UserWriterRepository;

class UserWriterService
{
    private UserWriterRepository $userWriterRepository;

    public function __construct(UserWriterRepository $userWriterRepository)
    {
        $this->userWriterRepository = $userWriterRepository;
    }

    public function __toString()
    {
        return 'UserWriterService';
    }

    public function saveUserInDB (User $user): User
    {
        return $this->userWriterRepository->saveUserInDB($user);
    }
}