<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Interfce\Category;

use App\Movie\Domain\Entity\Category;

interface CategoryReaderInterface
{
    function getCategoryByNme(string $name): ?Category;
}