<?php

namespace App\User\Presentation\Request\User;

use App\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ListingRequest
{
    private array $data;
    public ?int $limit;
    public ?int $page;
    public ?string $orderBy;
    public ?string $orderDirection;
    public array $filters = [];

    public function __construct(Request $request)
    {
        $this->data = ! empty($request->query->all()) ? $request->query->all() : [];
        $this->limit = $this->data['limit'] ?? null;
        $this->page = $this->data['page'] ?? null;
        $this->orderBy = ! empty($this->data['sort']) ? str_starts_with($this->data['sort'], '-') ? substr($this->data['sort'], 1) : $this->data['sort'] : null;
        $this->orderDirection = ! empty($this->data['sort']) ? str_starts_with($this->data['sort'], '-') ? 'DESC' : 'ASC' : null;
        $this->filters = array_filter($this->data, fn ($key) => in_array($key, User::getAttributes()), ARRAY_FILTER_USE_KEY);

        foreach ($this->data as $key => $val) {
            if ($key === 'deleted' && in_array($val, ["0", "1", "true", "false"])) {
                $this->filters[$key] = $val;
            }
            if ($key === 'phrase') {
                $this->filters[$key] = $val;
            }
        }
    }

    public function getLimit(): ?int
    {
        return $this->limit;
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