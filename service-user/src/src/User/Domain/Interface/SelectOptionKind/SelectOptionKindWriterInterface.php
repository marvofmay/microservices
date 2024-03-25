<?php

namespace App\User\Domain\Interface\SelectOptionKind;

use App\User\Domain\Entity\SelectOptionKind;

interface SelectOptionKindWriterInterface
{
    function saveSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind;
    function updateSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind;
}