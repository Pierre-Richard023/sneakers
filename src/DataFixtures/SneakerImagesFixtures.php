<?php

namespace App\DataFixtures;

use App\Entity\SneakersImages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class SneakerImagesFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private KernelInterface $kernel)
    {

    }

    public function load(ObjectManager $manager): void
    {

        $pics = [
            'models_1.jpg', 'models_2.jpg', 'models_3.jpg', 'models_4.jpg', 'models_5.jpg'
        ];

        $projectDir = $this->kernel->getProjectDir();
        $publicDir = $projectDir . '/public';


        for ($index = 1; $index < 301; $index++) {
            $sneaker = $this->getReference('sneaker' . $index);
            foreach ($pics as $pic) {
                $sneakerImage = new SneakersImages();

                $filePath = $publicDir . '/images/models/' . $pic;
//                $filename = uniqid() . '.jpg';
//                $file = new UploadedFile($filePath, $filename);
//                $sneakerImage->setImageName('Nom de l\'image');

                $imageFile = new File($filePath);

                $sneakerImage->setSneaker($sneaker)
                    ->setImageFile($imageFile);
                $manager->persist($sneakerImage);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SneakerFixtures::class
        ];
    }
}
