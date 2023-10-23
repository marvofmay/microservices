<?php

namespace App\Tests\Movie\Unit\QueryHandler;

use App\Movie\Application\Query\GetMoviesQuery;
use App\Movie\Application\QueryHandler\GetMoviesQueryHandler;
use DG\BypassFinals;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\TestCase;

class GetMoviesQueryHandlerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        BypassFinals::enable();
    }

    public function testRandomThreeMovies(): void
    {
        $query = $this->createMock(Query::class);
        $query->expects($this->once())
            ->method('getResult')
            ->willReturn([]);
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects($this->once())
            ->method('select')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('from')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('orderBy')
            ->with($this->callback(function ($arg) {
                return $arg === 'RAND()';
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setMaxResults')
            ->with($this->callback(function ($arg) {
                return $arg === 3;
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setFirstResult')
            ->with($this->callback(function ($arg) {
                return is_int($arg);
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilder);

        $getMoviesQuery = $this->createMock(GetMoviesQuery::class);
        $getMoviesQuery->expects($this->once())
            ->method('getAlgorithm')
            ->willReturn(1);
        $getMoviesQuery->expects($this->once())
            ->method('getLimit')
            ->willReturn(10);
        $getMoviesQuery->expects($this->once())
            ->method('getPage')
            ->willReturn(10);
        $getMoviesQuery->expects($this->once())
            ->method('getOrderDirection')
            ->willReturn('DESC');
        $getMoviesQuery->expects($this->once())
            ->method('getFilters')
            ->willReturn([]);

        $getMoviesQueryHandler = new GetMoviesQueryHandler($entityManager);
        $getMoviesQueryHandler->handle($getMoviesQuery);
    }

    public function testEvenNumberOfLettersInMovieTitleAndStartWithW(): void
    {
        $query = $this->createMock(Query::class);
        $query->expects($this->once())
            ->method('getResult')
            ->willReturn([]);
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects($this->once())
            ->method('select')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('from')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->exactly(2))
            ->method('andWhere')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->exactly(2))
            ->method('setParameter')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('orderBy')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setMaxResults')
            ->with($this->callback(function ($arg) {
                return $arg === 10;
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setFirstResult')
            ->with($this->callback(function ($arg) {
                return is_int($arg);
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilder);

        $getMoviesQuery = $this->createMock(GetMoviesQuery::class);
        $getMoviesQuery->expects($this->once())
            ->method('getAlgorithm')
            ->willReturn(2);
        $getMoviesQuery->expects($this->once())
            ->method('getLimit')
            ->willReturn(10);
        $getMoviesQuery->expects($this->once())
            ->method('getPage')
            ->willReturn(10);
        $getMoviesQuery->expects($this->once())
            ->method('getOrderDirection')
            ->willReturn('DESC');
        $getMoviesQuery->expects($this->once())
            ->method('getFilters')
            ->willReturn([]);

        $getMoviesQueryHandler = new GetMoviesQueryHandler($entityManager);
        $getMoviesQueryHandler->handle($getMoviesQuery);
    }

    public function testMoreThanOneWordInMovieTitle(): void
    {
        $query = $this->createMock(Query::class);
        $query->expects($this->once())
            ->method('getResult')
            ->willReturn([]);
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects($this->once())
            ->method('select')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('from')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('andWhere')
            ->with($this->callback(function ($arg) {
                return $arg === 'REGEXP(m.title, :regexp) = true';
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setParameter')
            ->with(
                $this->callback(function ($arg) {
                    return $arg === 'regexp';
                }),
                $this->callback(function ($arg) {
                    return $arg === '\s+';
                })
            )
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('orderBy')
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setMaxResults')
            ->with($this->callback(function ($arg) {
                return $arg === 20;
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('setFirstResult')
            ->with($this->callback(function ($arg) {
                return is_int($arg);
            }))
            ->willReturn($queryBuilder);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->once())
            ->method('createQueryBuilder')
            ->willReturn($queryBuilder);

        $getMoviesQuery = $this->createMock(GetMoviesQuery::class);
        $getMoviesQuery->expects($this->once())
            ->method('getAlgorithm')
            ->willReturn(3);
        $getMoviesQuery->expects($this->once())
            ->method('getLimit')
            ->willReturn(20);
        $getMoviesQuery->expects($this->once())
            ->method('getPage')
            ->willReturn(10);
        $getMoviesQuery->expects($this->once())
            ->method('getOrderDirection')
            ->willReturn('DESC');
        $getMoviesQuery->expects($this->once())
            ->method('getFilters')
            ->willReturn([]);

        $getMoviesQueryHandler = new GetMoviesQueryHandler($entityManager);
        $getMoviesQueryHandler->handle($getMoviesQuery);
    }
}