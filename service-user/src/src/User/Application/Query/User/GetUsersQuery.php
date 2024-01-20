<?php

declare(strict_types = 1);

namespace App\User\Application\Query\User;

use App\User\Domain\Entity\User;
use App\User\Presentation\Request\User\ListingRequest;

class GetUsersQuery
{
    private int $limit;
    private int $page;
    private int $offset;
    private string $orderBy;
    private string $orderDirection;
    private array $filters;

    public function __construct(ListingRequest $listingRequest)
    {
        $this->limit = $listingRequest->getLimit() ?? 10;
        $this->page = $listingRequest->getPage() ?? 1;
        $this->orderBy = $listingRequest->getOrderBy() ?? User::COLUMN_CREATED_AT;
        $this->orderDirection = $listingRequest->getOrderDirection() ?? 'DESC';
        $this->filters = $listingRequest->getFilters();
        $this->offset = ($this->page - 1) * $this->limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getOffset(): int
    {
        return $this->offset;
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