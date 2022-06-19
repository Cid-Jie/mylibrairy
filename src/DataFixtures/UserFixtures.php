<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('pcidjie@monsite.com')
            ->setRoles(['ROLE_ADMIN'])
        ;

        $hash = $this->passwordHasher->hashPassword($user, 'cidjie');
        $user->setPassword($hash);

        $manager->persist($user);
        $manager->flush();

        $faker = Factory::create();
        $user2 = new User();
        $user2
            ->setEmail($faker->email())
            ->setRoles(['ROLE_USER'])
        ;
        $hash2 = $this->passwordHasher->hashPassword(
            $user2,
            'userpass'
        );
        $user2->setPassword($hash2);

        $manager->persist($user2);
        $manager->flush();
        
    }
}