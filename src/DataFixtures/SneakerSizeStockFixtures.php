<?php

namespace App\DataFixtures;

use App\Entity\SneakerSizeStock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SneakerSizeStockFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $jsonFile = $this->parameterBag->get('kernel.project_dir') . '/public/utils/sneakers.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data['sneakers'])) {


            foreach ($data['sneakers'] as $sneaker) {

                for ($size = 40; $size <= 46; $size += 0.5) {

                    $sneakerSizeStock = new SneakerSizeStock();
                    $sneakerSizeStock->setSneakerSize($this->getReference('sneaker_size_' . $size))
                        ->setSneaker($this->getReference('sneaker_' . $sneaker["id"]))
                        ->setStock(rand(0, 4));

                    $manager->persist($sneakerSizeStock);
                }
            }

            $manager->flush();

        }

    }

    public function getDependencies()
    {
        return [
            SneakerFixtures::class,
            SneakerSizeFixtures::class,
        ];
    }
}
