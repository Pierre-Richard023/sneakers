<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail("user@test.com")
            ->setClientNumber("CLI002456")
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setPassword($this->hasher->hashPassword($user,"Azerty_0"))
            ->setIsVerified(true)
            ->setRegisteredSince(new \DateTime())
        ;

        $manager->persist($user);
        $manager->flush();
    }
}