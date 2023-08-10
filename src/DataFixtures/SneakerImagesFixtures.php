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


        for ($index = 1; $index < 17; $index++) {
            $sneaker = $this->getReference('sneaker' . $index);
            $brandName = $sneaker->getModel()->getBrands()->getName();
            $randomNumber = random_int(1, 2);

            for ($i = 1; $i < 4; $i++) {

                $fln = str_replace(' ', '_', $brandName) . '_V' . $randomNumber . '_' . $i;

                $sneakerImage = new SneakersImages();

                $filePath = $publicDir . '/images/models/' . $fln . '.webp';
                $copyPath = $publicDir . '/images/copies/' . basename($filePath);
                copy($filePath, $copyPath);

                $imageFile = new UploadedFile(
                    $copyPath,
                    basename($copyPath),
                    'image/png',
                    null,
                    true
                );

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
