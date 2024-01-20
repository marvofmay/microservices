<?php

namespace App\Movie\Presentation\Request;

use App\Movie\Domain\DTO\ListingMovieDTO;
use App\Movie\Domain\Entity\Movie;

class ListingMovieRequest
{
    private ?int $algorithm;
    private ?int $limit;
    private ?int $page;
    private ?string $orderBy;
    private ?string $orderDirection;
    private array $filters = [];

    public function __construct(ListingMovieDTO $listingMovieDTO)
    {
        $this->filters = [];
        if (! empty($listingMovieDTO->title)) {
            $this->filters[Movie::COLUMN_TITLE] = $listingMovieDTO->title;
        }
        if (is_bool($listingMovieDTO->active)) {
            $this->filters[Movie::COLUMN_ACTIVE] = $listingMovieDTO->active;
        }
        if (is_bool($listingMovieDTO->deleted)) {
            $this->filters['deleted'] = $listingMovieDTO->deleted;
        }
        if (! empty($listingMovieDTO->phrase)) {
            $this->filters['phrase'] = $listingMovieDTO->phrase;
        }

        $sort = $listingMovieDTO->sort;
        $this->algorithm = $listingMovieDTO->algorithm ?? null;
        $this->limit = $listingMovieDTO->limit ?? null;
        $this->page = $listingMovieDTO->page ?? null;
        $this->orderBy = ! empty($sort) ? str_starts_with($sort, '-') ? substr($sort, 1) : $sort : null;
        $this->orderDirection = ! empty($sort) ? str_starts_with($sort, '-') ? 'DESC' : 'ASC' : null;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getAlgorithm(): ?int
    {
        return $this->algorithm;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function getFilters (): array
    {
        return $this->filters;
    }
}