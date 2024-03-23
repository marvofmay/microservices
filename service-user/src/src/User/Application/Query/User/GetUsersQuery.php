<?php

declare(strict_types = 1);

namespace App\User\Application\Query\User;

use App\User\Domain\Entity\User;
use App\User\Presentation\Request\User\ListingRequest;

class GetUsersQuery
{
    public function __construct(
        private readonly ListingRequest $listingRequest,
        private int $limit = 10,
        private int $page = 1,
        private int $offset = 0,
        private string $orderBy = User::COLUMN_CREATED_AT,
        private string $orderDirection = 'DESC',
        private array $filters = []
    ) {
        $this->limit = $listingRequest->getLimit() ?? $this->getLimit();
        $this->page = $listingRequest->getPage() ?? $this->getPage();
        $this->orderBy = $listingRequest->getOrderBy() ?? User::COLUMN_CREATED_AT;
        $this->orderDirection = $listingRequest->getOrderDirection() ?? 'DESC';
        $this->filters = $listingRequest->getFilters();
        $this->offset = ($this->getPage() - 1) * $this->getLimit();
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