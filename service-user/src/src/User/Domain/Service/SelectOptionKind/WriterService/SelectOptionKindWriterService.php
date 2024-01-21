<?php

namespace App\User\Domain\Service\SelectOptionKind\WriterService;

use App\User\Domain\Entity\SelectOptionKind;
use App\User\Domain\Repository\SelectOptionKind\WriterRepository\SelectOptionKindWriterRepository;

class SelectOptionKindWriterService
{
    public function __construct(private readonly SelectOptionKindWriterRepository $selectOptionKindWriterRepository) { }

    public function __toString()
    {
        return 'SelectOptionKindWriterService';
    }

    public function saveSelectOptionKindInDB (SelectOptionKind $selectOptionKind): SelectOptionKind
    {
        return  $this->selectOptionKindWriterRepository->saveSelectOptionKindInDB($selectOptionKind);
    }

    public function updateSelectOptionKindInDB (SelectOptionKind $selectOptionKind): SelectOptionKind
    {
        return $this->selectOptionKindWriterRepository->updateSelectOptionKindInDB($selectOptionKind);
    }
}