<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $user = $this->getReference('user', User::class);
        for ($i = 0; $i < 3; $i++) {

            $address = new Address();

            $address->setFirstName($user->getFirstName())
                ->setLastName($user->getLastname())
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostalCode($faker->postcode())
                ->setCountry($faker->country())
                ->setPhoneNumber($faker->phoneNumber())
                ->setUser($user);
            $manager->persist($address);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
