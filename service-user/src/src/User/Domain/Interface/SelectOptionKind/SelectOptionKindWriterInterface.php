<?php

namespace App\User\Domain\Interface\SelectOptionKind;

use App\User\Domain\Entity\SelectOptionKind;

interface SelectOptionKindWriterInterface
{
    public function saveSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind;
    public function updateSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind;
}