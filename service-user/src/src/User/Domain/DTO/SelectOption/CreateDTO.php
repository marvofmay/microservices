<?php

declare(strict_types = 1);

namespace App\User\Domain\DTO\SelectOption;

use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateDTO implements RequestDtoInterface
{
    public const KINDS = ['skill', 'interest', 'role'];

    #[Assert\NotBlank(message: "option's value is required!!")]
    #[Assert\Regex(
        pattern: '/^[\w]+(?:_[\w]+)*$/',
        message: 'only letters or number joined by a "_"',
    )]
    #[Assert\Length(min: 2, max: 50, minMessage: 'minimum 1 characters', maxMessage: 'maximum 30 characters')]
    public string $value;

    #[Assert\NotBlank(message: "option's name is required!!")]
    #[Assert\Length(min: 2, max: 50, minMessage: 'minimum 3 letters', maxMessage: 'maximum 50 letters')]
    public string $name;

    #[Assert\NotBlank(message: "option's kind is required!!")]
    #[Assert\Choice(self::KINDS, message: 'kind only: skill, interest, role')]
    public string $kind;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKind(): string
    {
        return $this->kind;
    }
}