<?php

namespace App\User\Domain\Interface\SelectOption;

use App\User\Domain\Entity\SelectOption;

interface SelectOptionReaderInterface
{
    public function getSelectOptionByUUID(string $uuid): ?SelectOption;
    public function getSelectOptionsKinds(): mixed;
}