<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\SelectOptionKind;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateDTO implements RequestDtoInterface
{
    #[Assert\NotBlank(message: "option's name is required!!")]
    #[Assert\Length(min: 2, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $name;

    public function getName(): string
    {
        return $this->name;
    }
}