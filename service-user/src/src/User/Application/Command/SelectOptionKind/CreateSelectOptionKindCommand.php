<?php

declare(strict_types = 1);

namespace App\User\Application\Command\SelectOptionKind;

class CreateSelectOptionKindCommand
{
    public function __construct(public string $name) {}
}