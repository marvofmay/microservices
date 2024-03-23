<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class RestoreDeletedUserCommand
{
    public function __construct(public User $user) {}
}