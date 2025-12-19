<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // Admin
        $admin = new User();
        $admin->setEmail('admin@test.com');
        $admin->setFirstname('Admin');
        $admin->setLastname('User');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'adminpass')
        );

        $manager->persist($admin);

        // User classique
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, '1234')
        );

        $manager->persist($user);

        $manager->flush();
    }
}