<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\SelectOptionKind\WriterRepository;

use App\User\Domain\Entity\SelectOptionKind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SelectOptionKindWriterRepository extends ServiceEntityRepository
{
    public function __construct(private readonly ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectOptionKind::class);
    }

    public function saveSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind
    {
        $this->getEntityManager()->persist($selectOptionKind);
        $this->getEntityManager()->flush();

        return $selectOptionKind;
    }

    public function updateSelectOptionKindInDB(SelectOptionKind $selectOptionKind): SelectOptionKind
    {
        $this->getEntityManager()->flush();

        return $selectOptionKind;
    }
}