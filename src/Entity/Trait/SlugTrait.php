<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait SlugTrait
{
    #[ORM\Column(type: 'string',length: 255)]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private $slug;

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }


}