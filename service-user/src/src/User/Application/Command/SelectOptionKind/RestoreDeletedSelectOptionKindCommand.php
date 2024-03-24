<?php

namespace App\User\Application\Command\SelectOptionKind;

use App\User\Domain\Entity\SelectOptionKind;

class RestoreDeletedSelectOptionKindCommand
{
    public function __construct(private readonly SelectOptionKind $selectOptionKind) {}

    public function getSelectOptionKind(): SelectOptionKind
    {
        return $this->selectOptionKind;
    }
}