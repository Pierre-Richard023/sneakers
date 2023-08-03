<?php

namespace App\DataFixtures;

use App\Entity\Models;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ModelsFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {


        $brands = [
            "Nike", "Adidas", "Air Jordan", "New Balance", "Yeezy", "Asics"
        ];

        $index=1;
        $idx=1;

        foreach ($brands as $brand) {

            for ($i = 0; $i < 5; $i++) {

                $name=$brand." Models  " . $i;
                $models = new Models();
                $models->setName($name)
                    ->setBrands($this->getReference('brands' . $index))
                    ->setSlug($this->slugger->slug($name))
                ;
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
