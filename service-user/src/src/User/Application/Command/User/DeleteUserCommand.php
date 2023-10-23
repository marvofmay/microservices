<?php

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class DeleteUserCommand
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}