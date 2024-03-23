<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class ChangeUserPasswordCommand
{
    public function __construct(public string $newPassword, public User $user) {}
}