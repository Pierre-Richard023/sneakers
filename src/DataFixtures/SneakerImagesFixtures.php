<?php

namespace App\DataFixtures;

use App\Entity\Sneaker;
use App\Entity\SneakersImages;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SneakerImagesFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private ParameterBagInterface $parameterBag) {}

    public function load(ObjectManager $manager): void
    {
        $jsonFile = $this->parameterBag->get('kernel.project_dir') . '/public/utils/sneakers.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data['sneakers'])) {

            $publicDir = $this->parameterBag->get('kernel.project_dir') . "/public";

            foreach ($data['sneakers'] as $sneaker) {


                foreach ($sneaker['images'] as $image) {
                    $sneakersImage = new SneakersImages();

                    $filePath = $publicDir . '/utils/Sneakers/' . $image;
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $copyPath = $publicDir . '/images/copies/' . basename($filePath);
                    copy($filePath, $copyPath);

                    $imageFile = new UploadedFile(
                        $copyPath,
                        basename($copyPath),
                        'image/' . $extension,
                        null,
                        true
                    );

                    $sneakersImage
                        ->setSneaker($this->getReference('sneaker_' . $sneaker['id'], Sneaker::class))
                        ->setImageFile($imageFile);
                    $manager->persist($sneakersImage);
                }
            }

            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            SneakerFixtures::class
        ];
    }
}
