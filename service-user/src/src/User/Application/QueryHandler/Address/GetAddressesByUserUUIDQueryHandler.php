<?php

declare(strict_types = 1);

namespace App\User\Application\QueryHandler\Address;

use App\User\Application\Query\Address\GetAddressesByUserUUIDQuery;
use App\User\Domain\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;

class GetAddressesByUserUUIDQueryHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    public function handle(GetAddressesByUserUUIDQuery $query): array
    {
        $userUUID = $query->getUserUUID();
        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select(
                'a.' . Address::COLUMN_UUID,
                'a.' . Address::COLUMN_STREET,
                'a.' . Address::COLUMN_POSTCODE,
                'a.' . Address::COLUMN_CITY,
                'a.' . Address::COLUMN_COUNTRY,
                'a.' . Address::COLUMN_TYPE,
                'a.' . Address::COLUMN_CREATED_AT,
                'a.' . Address::COLUMN_UPDATED_AT,
                'a.' . Address::COLUMN_DELETED_AT
            )
            ->where('a.' . Address::COLUMN_USER_UUID . ' = :user_uuid')
            ->setParameter('user_uuid', $userUUID)
            ->from(Address::class, 'a');

        return $queryBuilder->getQuery()->getArrayResult();
    }
}
