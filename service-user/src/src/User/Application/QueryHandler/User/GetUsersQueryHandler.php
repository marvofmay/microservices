<?php

namespace App\User\Application\QueryHandler\User;

use App\User\Application\Query\User\GetUsersQuery;
use App\User\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class GetUsersQueryHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(GetUsersQuery $query)
    {
        $limit = $query->getLimit();
        $page = $query->getPage();
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();
        $offset = ($page - 1) * $limit;
        $filters = $query->getFilters();

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u');

        if (!empty($filters)) {
            foreach ($filters as $fieldName => $fieldValue) {
                $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->like('u.' . $fieldName, ':fieldValue'))
                    ->setParameter('fieldValue', '%' . $fieldValue . '%');
            }
        }

        $queryBuilder = $queryBuilder->orderBy('u.' . $orderBy, $orderDirection)
            ->setMaxResults($limit)
            ->setFirstResult($offset);


        return $queryBuilder->getQuery()->getResult();
    }
}
