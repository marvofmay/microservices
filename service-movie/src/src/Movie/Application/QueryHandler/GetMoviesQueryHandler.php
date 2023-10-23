<?php

namespace App\Movie\Application\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Domain\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetMoviesQueryHandler
{
    private EntityManagerInterface $entityManager;
    private ?int $algorithm;
    private int $limit;
    private int $page;
    private string $orderBy;
    private string $orderDirection;
    private array $filters;
    private int $offset;
    private QueryBuilder $queryBuilder;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(GetMoviesQuery $query)
    {
        $this->algorithm = $query->getAlgorithm();
        $this->limit = $query->getLimit();
        $this->page = $query->getPage();
        $this->orderBy = $query->getOrderBy();
        $this->orderDirection = $query->getOrderDirection();
        $this->offset = ($this->page - 1) * $this->limit;
        $this->filters = $query->getFilters();

        $this->makeQueryBuilder();
        if (!empty($filters)) {
            $this->setFilters();
        }

        switch ($this->algorithm) {
            case 1:
                $this->randomThreeMovies();
                break;
            case 2:
                $this->evenNumberOfLettersInMovieTitleAndStartWithW();
                break;
            case 3:
                $this->moreThanOneWordInMovieTitle();
                break;
        }

        if (1 !== $this->algorithm) {
            $this->queryBuilder = $this->queryBuilder->orderBy('m.' . $this->orderBy, $this->orderDirection)
                ->setMaxResults($this->limit)
                ->setFirstResult($this->offset);
        }

        return $this->queryBuilder->getQuery()->getResult();
    }

    private function makeQueryBuilder(): self
    {
        $this->queryBuilder = $this->entityManager
            ->createQueryBuilder()
            ->select('m')
            ->from(Movie::class, 'm');

        return $this;
    }

    private function setFilters(): void
    {
        foreach ($this->filters as $fieldName => $fieldValue) {
            $this->queryBuilder = $this->queryBuilder->andWhere($this->queryBuilder->expr()->like('m.' . $fieldName, ':fieldValue'))
                ->setParameter('fieldValue', '%' . $fieldValue . '%');
        }
    }

    private function randomThreeMovies (): void
    {
        $this->queryBuilder = $this->queryBuilder
            ->orderBy('RAND()')
            ->setMaxResults(3)
            ->setFirstResult($this->offset);
    }

    private function evenNumberOfLettersInMovieTitleAndStartWithW (): void
    {
        $this->queryBuilder = $this->queryBuilder->andWhere('REGEXP(m.title, :regexp) = true')
            ->setParameter('regexp', '\b(?:\w{2})*\w*\b')
            ->andWhere('REGEXP(m.title, :regexp) = true')
            ->setParameter('regexp', '^W.');
    }

    public function moreThanOneWordInMovieTitle(): void
    {
        $this->queryBuilder = $this->queryBuilder->andWhere('REGEXP(m.title, :regexp) = true')
            ->setParameter('regexp', '\s+');
    }
}
