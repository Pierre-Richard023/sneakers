<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use App\Entity\Sneaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


class SneakersFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private readonly SluggerInterface $slugger, private readonly ParameterBagInterface $parameterBag) {}

    public function load(ObjectManager $manager): void
    {
        $jsonFile = $this->parameterBag->get('kernel.project_dir') . '/public/utils/sneakers.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data)) {
            $publicDir = $this->parameterBag->get('kernel.project_dir') . "/public";


            foreach ($data as $brandName => $sneakers) {


                $brand = $this->getReference('brands_' . $brandName, Brands::class);
                $brandCode = strtoupper(substr($brand->getName(), 0, 3));

                foreach ($sneakers as $s) {

                    $sneaker = new Sneaker();

                    $filePath = $publicDir . '/utils/sneakers/' . $s["image"];
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


                    $randNumber = str_pad(random_int(1, 999999), 6, '0', STR_PAD_LEFT);

                    $sneaker->setName($s["name"])
                        ->setDetails($s["description"])
                        ->setReleaseDate(date_create_from_format("m/d/y", $s["release"]))
                        ->setPrice($s["price"])
                        ->setColor($s["color"])
                        ->setBrand($brand)
                        ->setSlug($this->slugger->slug($s["name"])->lower())
                        ->setArticleNumber(
                            sprintf(
                                'ART-%s-%s',
                                $brandCode,
                                $randNumber
                            )
                        )
                        ->setImageFile($imageFile);

                    $manager->persist($sneaker);
                }
            }


            $manager->flush();
        }
    }

    public function getDependencies(): array
    {
        return [
            BrandsFixtures::class,
        ];
    }
}
