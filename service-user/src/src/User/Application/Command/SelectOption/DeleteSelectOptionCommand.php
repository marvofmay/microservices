<?php

namespace App\User\Application\Command\SelectOption;

use App\User\Domain\Entity\SelectOption;

class DeleteSelectOptionCommand
{
    public function __construct(private readonly SelectOption $selectOption) {}

    public function getSelectOption(): SelectOption
    {
        return $this->selectOption;
    }
}