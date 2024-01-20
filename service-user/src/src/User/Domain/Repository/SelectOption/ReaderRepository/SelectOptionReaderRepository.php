<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\SelectOption\ReaderRepository;

use App\User\Domain\Entity\SelectOption;
use App\User\Domain\Exception\NotExistsException;
use App\User\Domain\Exception\NotFindByUUIDException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SelectOptionReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectOption::class);
    }

    public function getSelectOptionByUUID(string $uuid): ?SelectOption
    {
        $user = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('so')
            ->from(SelectOption::class, 'so')
            ->where('so.' . SelectOption::COLUMN_UUID . ' = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$user) {
            throw new NotFindByUUIDException('Select option not found by uuid: ' . $uuid);
        }

        return $user;
    }

    public function getSelectOptions()
    {
        $selectOptions = $this->getEntityManager()
            ->createQueryBuilder()
            ->getQuery()
            ->getResult();

        if (! $selectOptions) {
            throw new NotExistsException('Select options not exists.');
        }

        return $selectOptions;
    }

    public function getSelectOptionsKinds()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('so.' . SelectOption::COLUMN_KIND)
            ->from(SelectOption::class, 'so')
            ->orderBy('so.' . SelectOption::COLUMN_KIND)
            ->groupBy('so.' . SelectOption::COLUMN_KIND)
            ->getQuery()
            ->getResult();
    }
}