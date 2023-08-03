<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class BrandsFixtures extends Fixture
{

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $brands = [
            "Nike", "Adidas", "Air Jordan", "New Balance", "Yeezy", "Asics"
        ];

        $i=1;

        foreach ($brands as $b) {
            $brand = new Brands();
            $brand->setName($b)
                ->setSlug($this->slugger->slug($b))
            ;
            $this->addReference('brands' . $i, $brand);
            $manager->persist($brand);

            $i++;
        }

        $manager->flush();
    }
}
