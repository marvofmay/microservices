<?php

namespace App\User\Application\Command\SelectOption;

use App\User\Domain\Entity\SelectOption;

class RestoreDeletedSelectOptionCommand
{
    public function __construct(private readonly SelectOption $selectOption)
    {
    }

    public function getSelectOption(): SelectOption
    {
        return $this->selectOption;
    }
}