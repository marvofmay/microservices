<?php

namespace App\User\Domain\Service\SelectOption\WriterService;

use App\User\Domain\Entity\SelectOption;
use App\User\Domain\Interface\SelectOption\SelectOptionWriterInterface;

class SelectOptionWriterService
{
    public function __construct(private readonly SelectOptionWriterInterface $selectOptionWriterRepository) { }

    public function __toString()
    {
        return 'SelectOptionWriterService';
    }

    public function saveSelectOptionInDB (SelectOption $selectOption): SelectOption
    {
        return  $this->selectOptionWriterRepository->saveSelectOptionInDB($selectOption);
    }

    public function updateSelectOptionInDB (SelectOption $selectOption): SelectOption
    {
        return $this->selectOptionWriterRepository->updateSelectOptionInDB($selectOption);
    }
}