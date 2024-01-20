<?php

declare(strict_types = 1);

namespace App\User\Application\QueryHandler\SelectOption;

use App\User\Application\Query\SelectOption\GetSelectOptionsQuery;
use App\User\Domain\Entity\SelectOption;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetSelectOptionsQueryHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function handle(GetSelectOptionsQuery $query): array
    {
        $limit = $query->getLimit();
        $orderBy = $query->getOrderBy();
        $orderDirection = $query->getOrderDirection();
        $offset = $query->getOffset();
        $filters = $query->getFilters();

        $queryBuilder = $this->entityManager->createQueryBuilder()
            ->select('so')
            ->from(SelectOption::class, 'so');

        $queryBuilder = $this->setFilters($queryBuilder, $filters);

        $totalSelectOptions = count($queryBuilder->getQuery()->getResult());

        $queryBuilder = $queryBuilder->orderBy('so.' . $orderBy, $orderDirection)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        return [
            'totalSelectOptions' => $totalSelectOptions,
            'page' => $query->getPage(),
            'limit' => $query->getLimit(),
            'selectOptions' => $queryBuilder->getQuery()->getResult(),
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
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNull('so.' . SelectOption::COLUMN_DELETED_AT));
                        break;
                    case 1:
                        $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->isNotNull('so.' . SelectOption::COLUMN_DELETED_AT));
                        break;
                }
            }

            if (array_key_exists('phrase', $filters)) {
                $queryBuilder = $queryBuilder->andWhere(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like('LOWER(so. ' . SelectOption::COLUMN_VALUE. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(so.' . SelectOption::COLUMN_NAME. ')', ':searchPhrase'),
                        $queryBuilder->expr()->like('LOWER(so.' . SelectOption::COLUMN_KIND. ')', ':searchPhrase'),
                    )
                )
                ->setParameter('searchPhrase', '%' . strtolower($filters['phrase']) . '%');
            }
        }

        return $queryBuilder;
    }
}
