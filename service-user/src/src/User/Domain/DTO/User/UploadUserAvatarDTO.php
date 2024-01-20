<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\User;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UploadUserAvatarDTO implements RequestDtoInterface
{
    #[Assert\NotBlank]
    public string $uuid;

    #[Assert\NotBlank]
    public string $avatar;

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
}