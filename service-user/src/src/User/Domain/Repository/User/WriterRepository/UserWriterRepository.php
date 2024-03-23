<?php

declare(strict_types = 1);

namespace App\User\Domain\Repository\User\WriterRepository;

use App\User\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\User\Domain\Interface\UserWriterInterface;

class UserWriterRepository extends ServiceEntityRepository implements UserWriterInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function saveUserInDB(
        User $user,
        array $roles,
        array $addresses = [],
        array $skills = [],
        array $interests = []
    ): User
    {
        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();
        try {
            $entityManager->persist($user);
            foreach ($roles as $role) {
                $entityManager->persist($role);
            }
            foreach ($addresses as $address) {
                $entityManager->persist($address);
            }
            foreach ($skills as $skill) {
                $entityManager->persist($skill);
            }
            foreach ($interests as $interest) {
                $entityManager->persist($interest);
            }
            $entityManager->flush();
            $entityManager->commit();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }

        return $user;
    }

    public function updateUserInDB(
        User $user,
        array $roles,
        array $addresses,
        array $skills,
        array $interests
    ): User
    {
        $this->getEntityManager()->persist($user);
        if (! empty($roles)) {
            $currentRoles = $user->getRolesEntities();
            foreach ($currentRoles as $currentRole) {
                $this->getEntityManager()->remove($currentRole);
            }

            foreach ($roles as $role) {
                $this->getEntityManager()->persist($role);
            }
        }

        if (! empty($addresses)) {
            $currentAddresses = $user->getAddressesEntities();
            foreach ($currentAddresses as $currentAddress) {
                $this->getEntityManager()->remove($currentAddress);
            }

            foreach ($addresses as $address) {
                $this->getEntityManager()->persist($address);
            }
        }

        if (! empty($skills)) {
            $currentSkills = $user->getSkillsEntities();
            foreach ($currentSkills as $currentSkill) {
                $this->getEntityManager()->remove($currentSkill);
            }

            foreach ($skills as $skill) {
                $this->getEntityManager()->persist($skill);
            }
        }

        if (! empty($interests)) {
            $currentInterests = $user->getInterestsEntities();
            foreach ($currentInterests as $currentInterest) {
                $this->getEntityManager()->remove($currentInterest);
            }
            foreach ($interests as $interest) {
                $this->getEntityManager()->persist($interest);
            }
        }

        $this->getEntityManager()->flush();

        return $user;
    }
}