<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\SelectOptionKind;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateDTO implements RequestDtoInterface
{
    public const KINDS = ['skill', 'interest', 'role'];

    #[Assert\NotBlank()]
    public string $uuid;

    #[Assert\NotBlank(message: "option kind name is required!!")]
    #[Assert\Length(min: 2, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $name;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}