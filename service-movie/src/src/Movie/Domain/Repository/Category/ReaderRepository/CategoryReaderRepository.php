<?php

declare(strict_types = 1);

namespace App\Movie\Domain\Repository\Category\ReaderRepository;

use App\Movie\Domain\Entity\Category;

use App\Movie\Domain\Interfce\Category\CategoryReaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class CategoryReaderRepository extends ServiceEntityRepository implements CategoryReaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getCategoryByNme(string $name): ?Category
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM App\Movie\Domain\Entity\Category c WHERE c.' . Category::COLUMN_NAME . ' = :name')
            ->setParameter('name', $name)
            ->getOneOrNullResult();
    }
}