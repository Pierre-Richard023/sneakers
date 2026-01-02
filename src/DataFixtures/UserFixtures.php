<?php

namespace App\DataFixtures;

use App\Entity\Favorites;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {


        $user = new User();
        $user->setEmail("user@test.com")
            ->setClientNumber("CLI002456")
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setPassword($this->hasher->hashPassword($user,"Azerty_0"))
            ->setIsVerified(true)
            ->setRegisteredSince(new \DateTime())
        ;

        $admin = new User();
        $admin->setEmail("admin@test.com")
            ->setClientNumber("CLI002457")
            ->setFirstName("Jane")
            ->setLastName("Doe")
            ->setPassword($this->hasher->hashPassword($user,"Azerty_0"))
            ->setIsVerified(true)
            ->setRegisteredSince(new \DateTime())
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
        ;



        $manager->persist($user);
        $manager->persist($admin);
        $this->addReference('user',$user);

        $favorites=new Favorites();
        $favorites->setCustomer($user);

        $favorites2=new Favorites();
        $favorites2->setCustomer($admin);

        $manager->persist($favorites);
        $manager->persist($favorites2);
        $manager->flush();
    }
}
