<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\SelectOptionKind\ReaderRepository;

use App\User\Domain\Entity\SelectOptionKind;
use App\User\Domain\Exception\NotFindByUUIDException;
use App\User\Domain\Interface\SelectOptionKind\SelectOptionKindReaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SelectOptionKindReaderRepository extends ServiceEntityRepository implements SelectOptionKindReaderInterface
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
}