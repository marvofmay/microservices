<?php

declare(strict_types = 1);

namespace App\User\Application\Command\User;

use App\User\Domain\Entity\User;

class UploadUserAvatarCommand
{
    public string $avatar;
    public User $user;

    public function __construct(string $avatar, User $user)
    {
        $this->avatar = $avatar;
        $this->user = $user;
    }
}