<?php

namespace App\User\Domain\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\User\Domain\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct (UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHaser = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setFirstName('John');
        $user1->setLastName('Wick');
        $user1->setEmail('john.wick@example.com');
        $user1->setPhone('123-456-789');
        $user1->setPassword('lorem', $this->passwordHaser);
        $user1->setActive(true);
        $user1->setRoles(['ROLE_USER']);

        $user2 = new User();
        $user2->setFirstName('Jane');
        $user2->setLastName('Smith');
        $user2->setEmail('jane.smith@example.com');
        $user2->setPhone('987-654-321');
        $user2->setPassword('ipsum', $this->passwordHaser);
        $user2->setActive(true);
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}