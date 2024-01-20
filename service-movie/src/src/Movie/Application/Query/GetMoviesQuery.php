<?php

namespace App\Movie\Application\Query;

use App\Movie\Presentation\Request\ListingMovieRequest;
use App\Movie\Domain\Entity\Movie;

class GetMoviesQuery
{
    private ?int $algorithm;
    private int $limit;
    private int $page;
    private string $orderBy;
    private string $orderDirection;
    private array $filters;

    public function __construct(ListingMovieRequest $listingMovieRequest)
    {
        $this->algorithm = $listingMovieRequest->getAlgorithm() ?? null;
        $this->limit = $listingMovieRequest->getLimit() ?? 10;
        $this->page = $listingMovieRequest->getPage() ?? 1;
        $this->orderBy = $listingMovieRequest->getOrderBy() ?? Movie::COLUMN_CREATED_AT;
        $this->orderDirection = $listingMovieRequest->getOrderDirection() ?? 'DESC';
        $this->filters = $listingMovieRequest->getFilters();
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