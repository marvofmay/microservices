<?php

declare(strict_types = 1);

namespace App\User\Application\Command\SelectOption;

use App\User\Domain\Entity\SelectOption;

class UpdateSelectOptionCommand
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $value,
        private readonly string $name,
        private readonly string $kind,
        private readonly SelectOption $selectOption
    ) {}

    public function getUuid(): string
    {
        return $this->uuid;
    }

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

    public function getSelectOption(): SelectOption
    {
        return $this->selectOption;
    }
}