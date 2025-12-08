<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use App\Entity\Sneaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class SneakerFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger, private ParameterBagInterface $parameterBag) {}

    public function load(ObjectManager $manager): void
    {

        $jsonFile = $this->parameterBag->get('kernel.project_dir') . '/public/utils/sneakers.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data['sneakers'])) {
            $publicDir = $this->parameterBag->get('kernel.project_dir') . "/public";


            foreach ($data['sneakers'] as $s) {

                $sneaker = new Sneaker();

                $filePath = $publicDir . '/utils/Sneakers/' . $s["profileImage"];
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


                $sneaker->setName($s["name"])
                    ->setDetails($s["details"])
                    ->setReleaseDate(date_create_from_format("d/m/y", $s["release_date"]))
                    ->setPrice($s["price"])
                    ->setColor($s["colors"])
                    ->setBrand($this->getReference('brands_' . $s["brand"], Brands::class))
                    ->setSlug($this->slugger->slug($s["name"])->lower())
                    ->setArticleNumber("ART" . $s["id"] . rand(2132, 9999))
                    ->setImageFile($imageFile);


                $this->addReference('sneaker_' . $s["id"], $sneaker);
                $manager->persist($sneaker);
            }


            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            BrandsFixtures::class,
            SneakerSizeFixtures::class,
        ];
    }
}
