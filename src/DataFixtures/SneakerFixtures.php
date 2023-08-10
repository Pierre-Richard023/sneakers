<?php

namespace App\DataFixtures;

use App\Entity\Sneaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class SneakerFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger,private KernelInterface $kernel){}

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        $color=[
            "Jaune","Rouge","Noir","Blanc","Rouge et Blanc","Noir et Blanc"
        ];

        $size=[
            40,40.5,41,41.5,42,42.5,43,43.5,44,44.5,45,45.5
        ];


        $index=1;

        $projectDir = $this->kernel->getProjectDir();
        $publicDir = $projectDir . '/public';



        for ($idx=1; $idx < 9 ; $idx++){

            $mdls=$this->getReference('models'.$idx);
            $modelName=$mdls->getName();
            $brandName=$mdls->getBrands()->getName();

            for ($i = 0; $i < 2; $i++) {

                $randomNumber = random_int(1, 2);

                $fln=str_replace(' ', '_', $brandName).'_V'.$randomNumber.'_profile.webp';

                $filePath = $publicDir . '/images/models/profile/' . $fln;
                $copyPath = $publicDir . '/images/copies/' . basename($filePath);
                copy($filePath, $copyPath);

                $imageFile = new UploadedFile(
                    $copyPath,
                    basename($copyPath),
                    'image/png',
                    null,
                    true
                );

                $sneaker = new Sneaker();

                $name =$modelName ." Edition " . $i;
                $sneaker->setName($name)
                    ->setArticleNumber("ART".$idx.$i.rand(2132,9999))
                    ->setColor($color[rand(0,count($color)-1)])
                    ->setShoeSize($size[rand(0,count($size)-1)])
                    ->setStock(rand(0, 20))
                    ->setPrice(rand(5000, 40000) / 100)
                    ->setModel($mdls)
                    ->setDetails($faker->realText())
                    ->setReleaseDate(new \DateTime())
                    ->setSlug($this->slugger->slug($name)->lower())
                    ->setImageFile($imageFile)
                ;
                $this->addReference('sneaker' .  $index, $sneaker);
                $index++;
                $manager->persist($sneaker);
            }

        }



        $manager->flush();
    }
    public function getDependencies(){
        return [
            ModelsFixtures::class,
        ];
    }

}
