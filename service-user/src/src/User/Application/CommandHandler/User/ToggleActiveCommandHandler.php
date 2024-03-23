<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\ToggleActiveCommand;
use App\User\Domain\Service\User\WriterService\UserWriterService;

class ToggleActiveCommandHandler
{
    public function __construct(private readonly UserWriterService $userWriterService) {}

    public function __invoke(ToggleActiveCommand $command): void
    {
        $user = $command->user;
        $user->setActive(! $user->getActive());

        $this->userWriterService->saveUserInDB($user);
    }
}