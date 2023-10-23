<?php

namespace App\Movie\Domain\DTO;

use App\Movie\Domain\Entity\Movie;
use Symfony\Component\HttpFoundation\Request;

class ListingDTO
{
    private array $data;
    private ?int $algorithm;
    private ?int $limit;
    private ?int $page;
    private ?string $orderBy;
    private ?string $orderDirection;
    private array $filters = [];

    public function __construct(Request $request)
    {
        $this->data = ! empty($request->query->all()) ? $request->query->all() : [];
        $this->algorithm = $this->data['algorithm'] ?? null;
        $this->limit = $this->data['limit'] ?? null;
        $this->page = $this->data['page'] ?? null;
        $this->orderBy = ! empty($this->data['sort']) ? str_starts_with($this->data['sort'], '-') ? substr($this->data['sort'], 1) : $this->data['sort'] : null;
        $this->orderDirection = ! empty($this->data['sort']) ? str_starts_with($this->data['sort'], '-') ? 'DESC' : 'ASC' : null;
        $this->filters = array_filter($this->data, fn ($key) => in_array($key, Movie::getAttributes()), ARRAY_FILTER_USE_KEY);
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