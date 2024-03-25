<?php

namespace App\User\Domain\Interface\SelectOption;

use App\User\Domain\Entity\SelectOption;

interface SelectOptionWriterInterface
{
    function saveSelectOptionInDB (SelectOption $selectOption): SelectOption;
    function updateSelectOptionInDB (SelectOption $selectOption): SelectOption;
}