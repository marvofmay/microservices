<?php

declare(strict_types = 1);

namespace App\User\Application\QueryHandler\User;

use App\User\Application\Query\User\GetUsersQuery;
use App\User\Domain\Entity\Interest;
use App\User\Domain\Entity\Role;
use App\User\Domain\Entity\Skill;
use App\User\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetUsersQueryHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(GetUsersQuery $query): array
    {
        $limit = $query->getLimit();
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();
        $offset = $query->getOffset();
        $filters = $query->getFilters();

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->leftJoin('u.' . User::RELATION_ROLES, 'r')
            ->leftJoin('u.' . User::RELATION_SKILLS, 's')
            ->leftJoin('u.' . User::RELATION_INTERESTS, 'i')
            ->groupBy('u.' . User::COLUMN_UUID);

        $queryBuilder = $this->setFilters($queryBuilder, $filters);

        $totalUsers = count($queryBuilder->getQuery()->getResult());

        $queryBuilder = $queryBuilder->orderBy('u.' . $orderBy, $orderDirection)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return [
            'totalUsers' => $totalUsers,
            'page' => $query->getPage(),
            'limit' => $query->getLimit(),
            'users' => $queryBuilder->getQuery()->getResult(),
        ];
    }

    private function setFilters (QueryBuilder $queryBuilder, array $filters): QueryBuilder
    {
        if (! empty($filters)) {
            foreach ($filters as $fieldName => $fieldValue) {
                if (in_array($fieldName, ['deleted', 'phrase'])) {
                    continue;
                }
                $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->like('u.' . $fieldName, ':fieldValue'))
                    ->setParameter('fieldValue', '%' . $fieldValue . '%');
            }

            if (array_key_exists('deleted', $filters)) {
                switch ($filters['deleted']) {
                    case 0:
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNull('u.' . User::COLUMN_DELETED_AT));
                        break;
                    case 1:
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNotNull('u.' . User::COLUMN_DELETED_AT));
                        break;
                }
            }

            if (array_key_exists('phrase', $filters)) {
                $queryBuilder = $queryBuilder->andWhere(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like('LOWER(u. ' . User::COLUMN_FIRST_NAME. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(u.' . User::COLUMN_LAST_NAME. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(u.' . User::COLUMN_EMAIL. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(u.' . User::COLUMN_PHONE. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(r.' . Role::COLUMN_NAME. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(s.' . Skill::COLUMN_NAME. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(i.' . Interest::COLUMN_NAME. ')', ':searchPhrase')
                    )
                )
                ->setParameter('searchPhrase', '%' . strtolower($filters['phrase']) . '%');
            }
        }

        return $queryBuilder;
    }
}
