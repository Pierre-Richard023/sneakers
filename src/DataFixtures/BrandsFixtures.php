<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = [
            "Nike", "Adidas", "Air Jordan", "New Balance", "Yeezy", "Asics"
        ];

        $i=1;

        foreach ($brands as $b) {
            $brand = new Brands();
            $brand->setName($b);
            $this->addReference('brands' . $i, $brand);
            $manager->persist($brand);

            $i++;
        }

        $manager->flush();
    }
}
