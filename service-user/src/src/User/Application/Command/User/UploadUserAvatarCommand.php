<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class UploadUserAvatarCommand
{
    public function __construct(public string $avatar, public User $user) {}
}