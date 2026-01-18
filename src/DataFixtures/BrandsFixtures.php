<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class BrandsFixtures extends Fixture
{


    public function __construct(private readonly SluggerInterface $slugger, private readonly ParameterBagInterface $parameterBag) {}

    public function load(ObjectManager $manager): void
    {
        $jsonFile = $this->parameterBag->get('kernel.project_dir') . '/public/utils/brands.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);



        if (isset($data)) {
            $publicDir = $this->parameterBag->get('kernel.project_dir') . "/public";

            foreach ($data as $b) {

                $filePath = $publicDir . '/utils/logo/' . $b['logo'];
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

                $brand = new Brands();
                $brand->setName($b['name'])
                    ->setSlug($this->slugger->slug($b['name']))
                    ->setImageFile($imageFile);
                $this->addReference('brands_' . $b['id'], $brand);
                $manager->persist($brand);
            }

            $manager->flush();
        }
    }
}
