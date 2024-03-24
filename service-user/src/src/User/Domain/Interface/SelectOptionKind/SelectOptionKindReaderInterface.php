<?php

namespace App\User\Domain\Interface\SelectOptionKind;

use App\User\Domain\Entity\SelectOptionKind;

interface SelectOptionKindReaderInterface
{
    public function getSelectOptionKindByUUID(string $uuid): ?SelectOptionKind;
}