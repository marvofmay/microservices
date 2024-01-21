<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\SelectOptionKind\ReaderRepository;

use App\User\Domain\Entity\SelectOptionKind;
use App\User\Domain\Exception\NotExistsException;
use App\User\Domain\Exception\NotFindByUUIDException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SelectOptionKindReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectOptionKind::class);
    }

    public function getSelectOptionKindByUUID(string $uuid): ?SelectOptionKind
    {
        $selectOptionKind = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sok')
            ->from(SelectOptionKind::class, 'sok')
            ->where('sok.' . SelectOptionKind::COLUMN_UUID . ' = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult();

        if (! $selectOptionKind) {
            throw new NotFindByUUIDException('Select option kind not found by uuid: ' . $uuid);
        }

        return $selectOptionKind;
    }

    public function getSelectOptionKinds()
    {
        $selectOptionKinds = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sok')
            ->from(SelectOptionKind::class, 'sok')
            ->getQuery()
            ->getResult();

        if (! $selectOptionKinds) {
            throw new NotExistsException('Select option kinds not exists.');
        }

        return $selectOptionKinds;
    }
}