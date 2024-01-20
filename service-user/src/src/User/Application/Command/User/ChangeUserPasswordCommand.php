<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class ChangeUserPasswordCommand
{
    public string $newPassword;
    public User $user;

    public function __construct(string $newPassword, User $user)
    {
        $this->newPassword = $newPassword;
        $this->user = $user;
    }
}