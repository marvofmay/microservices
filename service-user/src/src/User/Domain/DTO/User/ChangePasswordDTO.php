<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\User;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;


class ChangePasswordDTO implements RequestDtoInterface
{
    #[Assert\NotBlank(
        message: 'Old password is required.',
    )]
    #[SecurityAssert\UserPassword(
        message: 'Wrong value for your current password.',
    )]
    public string $oldPassword;

    #[Assert\NotBlank(
        message: 'New password is required.',
    )]
    #[Assert\NotEqualTo(
        propertyPath: "oldPassword",
        message: "New password must be different from the old one"
    )]
    public string $newPassword;

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}