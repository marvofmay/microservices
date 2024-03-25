<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Domain\Entity\Category;
use App\Movie\Domain\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetMoviesQueryHandler
{
    private int $limit;
    private int $page;
    private string $orderBy;
    private string $orderDirection;
    private array $filters;
    private int $offset;
    private QueryBuilder $queryBuilder;

    public function __construct(
        private readonly GetMoviesQuery $query,
        private readonly EntityManagerInterface $entityManager,
    ) {
        $this->limit = $this->query->getLimit();
        $this->page = $this->query->getPage();
        $this->orderBy = $this->query->getOrderBy();
        $this->orderDirection = $this->query->getOrderDirection();
        $this->offset = ($this->page - 1) * $this->limit;
        $this->filters = $this->query->getFilters();
    }

    public function handle(): array
    {
        $this->makeQueryBuilder();
        $this->setFilters();
        $totalMovies = $this->getTotalMovies();
        $this->setOrderBy();
        $this->setMaxResults();
        $this->setFirstResult();

        return [
            'totalMovies' => $totalMovies,
            'page' => $this->getPage(),
            'limit' => $this->getLimit(),
            'movies' => $this->getQueryBuilder()->getQuery()->getResult(),
        ];
    }

    public function makeQueryBuilder(): self
    {
        $this->queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from(Movie::class, 'm')
            ->join('m.' . Movie::RELATION_CATEGORIES, 'c')
            ->groupBy('m.' . Movie::COLUMN_UUID);

        $filters = $this->getEntityManager()->getFilters();
        $filters->disable('softdeleteable');

        return $this;
    }

    public function setFilters(): void
    {
        foreach ($this->filters as $fieldName => $fieldValue) {
            if ($fieldName === 'phrase' || $fieldName === 'deleted') {
                continue;
            }
            if ($fieldName === Movie::COLUMN_ACTIVE) {
                $this->queryBuilder = $this->getQueryBuilder()
                    ->andWhere('m.' . $fieldName . ' = :fieldValue')
                    ->setParameter('fieldValue', $fieldValue);
                continue;
            }
            $this->queryBuilder = $this->getQueryBuilder()
                ->andWhere($this->getQueryBuilder()->expr()->like('m.' . $fieldName, ':fieldValue'))
                ->setParameter('fieldValue', '%' . $fieldValue . '%');
        }

        if (array_key_exists('deleted', $this->filters)) {
            $this->queryBuilder = match ($this->filters['deleted']) {
                0 => $this->queryBuilder->andWhere($this->queryBuilder->expr()->isNull('m.' . Movie::COLUMN_DELETED_AT)),
                1 => $this->queryBuilder->andWhere($this->queryBuilder->expr()->isNotNull('m.' . Movie::COLUMN_DELETED_AT))
            };
        }

        if (array_key_exists('phrase', $this->filters)) {
            $this->queryBuilder = $this->queryBuilder->andWhere(
                $this->queryBuilder->expr()->orX(
                    $this->queryBuilder->expr()->like('LOWER(m. ' . Movie::COLUMN_TITLE . ')', ':searchPhrase'),
                    $this->queryBuilder->expr()->like('LOWER(c. ' . Category::COLUMN_NAME . ')', ':searchPhrase'),
                )
            )
                ->setParameter('searchPhrase', '%' . strtolower($this->filters['phrase']) . '%');
        }
    }

    public function setOrderBy(): void
    {
        $this->queryBuilder->orderBy('m.' . $this->getOrderBy(), $this->getOrderDirection());
    }

    public function setMaxResults(): void
    {
        $this->queryBuilder->setMaxResults($this->getLimit());
    }

    public function setFirstResult(): void
    {
        $this->queryBuilder->setFirstResult($this->getOffset());
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder): self
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    public function getTotalMovies (): int
    {
        return count($this->queryBuilder->getQuery()->getArrayResult());
    }
}
