<?php

namespace App\DataFixtures;

use App\Entity\Models;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {


        $brands = [
            "Nike", "Adidas", "Air Jordan", "New Balance", "Yeezy", "Asics"
        ];

        $index=1;
        $idx=1;

        foreach ($brands as $brand) {

            for ($i = 0; $i < 5; $i++) {

                $models = new Models();
                $models->setName($brand." Models  " . $i)
                    ->setBrands($this->getReference('brands' . $index));
                $this->addReference('models' . $idx, $models);
                $manager->persist($models);
                $idx++;

            }

            $index++;
        }
        $manager->flush();
    }

    public function getDependencies(){
        return [
            BrandsFixtures::class,
        ];
    }
}
