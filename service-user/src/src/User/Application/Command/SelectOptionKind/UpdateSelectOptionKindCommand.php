<?php

declare(strict_types = 1);

namespace App\User\Application\Command\SelectOptionKind;

use App\User\Domain\Entity\SelectOptionKind;

class UpdateSelectOptionKindCommand
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $name,
        private readonly SelectOptionKind $selectOptionKind
    ) { }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSelectOptionKind(): SelectOptionKind
    {
        return $this->selectOptionKind;
    }
}