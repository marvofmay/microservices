<?php

namespace App\User\Domain\Interface\SelectOption;

use App\User\Domain\Entity\SelectOption;

interface SelectOptionReaderInterface
{
    function getSelectOptionByUUID(string $uuid): ?SelectOption;
    function getSelectOptionsKinds(): mixed;
}