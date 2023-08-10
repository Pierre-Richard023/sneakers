<?php

namespace App\DataFixtures;

use App\Entity\Transporter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TransporterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 3; $i++) {

            $shipping = new Transporter();

            $shipping->setName('Transport ' . $i)
                ->setDescription('ddd ds mdf slfjsbgj sbhgbs glsmbdg sbg jsjgj s')
                ->setPrice(rand(500, 4000) / 100);
            $manager->persist($shipping);
        }

        $manager->flush();
    }
}
