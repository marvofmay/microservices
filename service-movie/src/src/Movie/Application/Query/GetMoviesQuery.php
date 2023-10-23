<?php

namespace App\Movie\Application\Query;

use App\Movie\Domain\DTO\ListingDTO;
use App\Movie\Domain\Entity\Movie;

class GetMoviesQuery
{
    private ?int $algorithm;
    private int $limit;
    private int $page;
    private string $orderBy;
    private string $orderDirection;
    private array $filters;

    public function __construct(ListingDTO $listingDTO)
    {
        $this->algorithm = $listingDTO->getAlgorithm() ?? null;
        $this->limit = $listingDTO->getLimit() ?? 10;
        $this->page = $listingDTO->getPage() ?? 1;
        $this->orderBy = $listingDTO->getOrderBy() ?? Movie::COLUMN_CREATED_AT;
        $this->orderDirection = $listingDTO->getOrderDirection() ?? 'DESC';
        $this->filters = $listingDTO->getFilters();
    }

    public function getAlgorithm(): ?int
    {
        return $this->algorithm;
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
}