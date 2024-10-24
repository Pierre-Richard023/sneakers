<?php

namespace App\DataFixtures;

use App\Entity\SneakerSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SneakerSizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($size = 40; $size <= 46; $size += 0.5) {
            $sneakerSize = new SneakerSize();
            $sneakerSize->setSize($size);
            $manager->persist($sneakerSize);
            $this->addReference('sneaker_size_' . $size, $sneakerSize);
        }

        $manager->flush();
    }
}
