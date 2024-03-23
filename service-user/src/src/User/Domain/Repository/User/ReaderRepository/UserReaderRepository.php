<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\User\ReaderRepository;

use App\User\Domain\Entity\User;
use App\User\Domain\Exception\NotFindByUUIDException;
use App\User\Domain\Exception\NotExistsException;
use App\User\Domain\Interface\UserReaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserReaderRepository extends ServiceEntityRepository implements UserReaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function getUserByUUID(string $uuid): ?User
    {
        $user = $this->getEntityManager()
            ->createQuery('SELECT u FROM App\User\Domain\Entity\User u WHERE u.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();

        if (!$user) {
            throw new NotFindByUUIDException('User not found by uuid: ' . $uuid);
        }

        return $user;
    }

    public function getNotDeletedUserByUUID(string $uuid): ?User
    {
        $user = $this->getEntityManager()
            ->createQuery('SELECT u FROM App\User\Domain\Entity\User u WHERE u.uuid = :uuid and u.deletedAt IS NULL')
            ->setParameter('uuid', $uuid)
            ->getOneOrNullResult();

        if (!$user) {
            throw new UserNotFindByUUIDException('User not found by uuid: ' . $uuid);
        }

        return $user;
    }

    public function getUsers(): mixed
    {
        $users = $this->getEntityManager()
            ->createQuery('SELECT u FROM App\User\Domain\Entity\User u ORDER BY u.createdAt')
            ->getResult();

        if (! $users) {
            throw new NotExistsException('Users not exists.');
        }

        return $users;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM App\User\Domain\Entity\User u WHERE u.email = :email'
            )
            ->setParameter('email', $email)
            ->getOneOrNullResult();
    }

    public function getUserByEmailAndNotEqualUUID(string $email, string $uuid): ?User
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM App\User\Domain\Entity\User u WHERE u.email = :email AND u.uuid <> :uuid'
            )
            ->setParameters(['email' => $email, 'uuid' => $uuid])
            ->getOneOrNullResult();
    }
}