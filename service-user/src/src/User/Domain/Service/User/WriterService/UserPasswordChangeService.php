<?php

namespace App\User\Domain\Service\User\WriterService;

use App\User\Domain\Entity\User;

class UserPasswordChangeService
{
    public function __construct() {}

    public function changePassword(User $user, string $oldPassword, string $newPassword): bool
    {
    }
}