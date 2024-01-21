<?php

declare(strict_types = 1);

namespace App\User\Application\QueryHandler\SelectOptionKind;

use App\User\Application\Query\SelectOptionKind\GetSelectOptionKindsQuery;
use App\User\Domain\Entity\SelectOptionKind;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetSelectOptionKindsQueryHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function handle(GetSelectOptionKindsQuery $query): array
    {
        $limit = $query->getLimit();
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();
        $offset = $query->getOffset();
        $filters = $query->getFilters();

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('sok')
            ->from(SelectOptionKind::class, 'sok');

        $queryBuilder = $this->setFilters($queryBuilder, $filters);

        $totalSelectOptions = count($queryBuilder->getQuery()->getResult());

        $queryBuilder = $queryBuilder->orderBy('sok.' . $orderBy, $orderDirection)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return [
            'totalSelectOptionKinds' => $totalSelectOptions,
            'page' => $query->getPage(),
            'limit' => $query->getLimit(),
            'selectOptionKinds' => $queryBuilder->getQuery()->getResult(),
        ];
    }

    private function setFilters (QueryBuilder $queryBuilder, array $filters): QueryBuilder
    {
        if (! empty($filters)) {
            foreach ($filters as $fieldName => $fieldValue) {
                if (in_array($fieldName, ['deleted', 'phrase'])) {
                    continue;
                }
                $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->like('so.' . $fieldName, ':fieldValue'))
                    ->setParameter('fieldValue', '%' . $fieldValue . '%');
            }

            if (array_key_exists('deleted', $filters)) {
                switch ($filters['deleted']) {
                    case 0:
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNull('sok.' . SelectOptionKind::COLUMN_DELETED_AT));
                        break;
                    case 1:
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNotNull('sok.' . SelectOptionKind::COLUMN_DELETED_AT));
                        break;
                }
            }

            if (array_key_exists('phrase', $filters)) {
                $queryBuilder = $queryBuilder->andWhere(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like('LOWER(sok.' . SelectOptionKind::COLUMN_NAME. ')', ':searchPhrase'),
                    )
                )
                ->setParameter('searchPhrase', '%' . strtolower($filters['phrase']) . '%');
            }
        }

        return $queryBuilder;
    }
}
