<?php

namespace App\User\Domain\Interface\SelectOption;

use App\User\Domain\Entity\SelectOption;

interface SelectOptionWriterInterface
{
    public function saveSelectOptionInDB (SelectOption $selectOption): SelectOption;
    public function updateSelectOptionInDB (SelectOption $selectOption): SelectOption;
}