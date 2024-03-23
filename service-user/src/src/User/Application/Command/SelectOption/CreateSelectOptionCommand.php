<?php

declare(strict_types = 1);

namespace App\User\Application\Command\SelectOption;

class CreateSelectOptionCommand
{
    public function __construct(public string $value, public string $name, public string $kind) {}
}