<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
trait SlugTrait
{
    #[ORM\Column(type: 'string',length: 255)]
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