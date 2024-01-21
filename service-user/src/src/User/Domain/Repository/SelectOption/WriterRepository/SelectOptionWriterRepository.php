<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\SelectOption\WriterRepository;

use App\User\Domain\Entity\SelectOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SelectOptionWriterRepository extends ServiceEntityRepository
{
    public function __construct(private readonly ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectOption::class);
    }

    public function saveSelectOptionInDB(SelectOption $selectOption): SelectOption
    {
        $this->getEntityManager()->persist($selectOption);
        $this->getEntityManager()->flush();

        return $selectOption;
    }

    public function updateSelectOptionInDB(SelectOption $selectOption): SelectOption
    {
        $this->getEntityManager()->flush();

        return $selectOption;
    }
}