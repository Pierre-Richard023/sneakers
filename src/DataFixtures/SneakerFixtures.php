<?php

namespace App\DataFixtures;

use App\Entity\Sneaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class SneakerFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {

        $color=[
            "Jaune","Rouge","Noir","Blanc","Rouge et Blanc","Noir et Blanc"
        ];

        $size=[
            40,40.5,41,41.5,42,42.5,43,43.5,44,44.5,45,45.5
        ];


        $index=1;

        for ($idx=1; $idx < 31 ; $idx++){

            $mdls=$this->getReference('models'.$idx);

            for ($i = 0; $i < 10; $i++) {
                $sneaker = new Sneaker();

                $name =$mdls->getName() ." Edition " . $i;
                $sneaker->setName($name)
                    ->setArticleNumber("ART".$idx.$i.rand(2132,9999))
                    ->setColor($color[rand(0,count($color)-1)])
                    ->setShoeSize($size[rand(0,count($size)-1)])
                    ->setStock(rand(0, 20))
                    ->setPrice(rand(5000, 40000) / 100)
                    ->setModel($mdls)
                    ->setDetails("Test msbf sjgn sddsmlg sdgsjdngsdgsdmfgnsdgnsddhshs")
                    ->setReleaseDate(new \DateTime())
                    ->setSlug($this->slugger->slug($name)->lower())
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
