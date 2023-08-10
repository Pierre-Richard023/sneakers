<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class BrandsFixtures extends Fixture
{

    public function __construct(private SluggerInterface $slugger, private KernelInterface $kernel)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $brands = [
            "Nike","Jordan", "New Balance", "Reebok"
        ];

        $i = 1;

        $projectDir = $this->kernel->getProjectDir();
        $publicDir = $projectDir . '\public';


        foreach ($brands as $b) {

            $filePath = $publicDir . '/images/Logo/' . str_replace(' ', '_', $b) . '.png';
            $copyPath = $publicDir . '/images/copies/' . basename($filePath);
            copy($filePath, $copyPath);

            $imageFile = new UploadedFile(
                $copyPath,
                basename($copyPath),
                'image/png',
                null,
                true
            );


            $brand = new Brands();
            $brand->setName($b)
                ->setSlug($this->slugger->slug($b))
                ->setImageFile($imageFile);
            $this->addReference('brands' . $i, $brand);
            $manager->persist($brand);

            $i++;
        }

        $manager->flush();
    }
}
