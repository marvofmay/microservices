<?php

namespace App\User\Domain\Service\SelectOption\ReaderService;

use App\User\Domain\Entity\SelectOption;
use App\User\Domain\Repository\SelectOption\ReaderRepository\SelectOptionReaderRepository;

class SelectOptionReaderService
{
    public function __construct(private readonly SelectOptionReaderRepository $selectOptionReaderRepository)
    { }

    public function getSelectOptionByUUID(string $uuid): ?SelectOption
    {
        return $this->selectOptionReaderRepository->getSelectOptionByUUID($uuid);
    }

    public function getSelectOptions()
    {
        return $this->selectOptionReaderRepository->getSelectOptions();
    }
}