<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class SneakerFilter
{

    private ArrayCollection $brands;

    private float|null $size=null;


    public function __construct()
    {
        $this->brands=new ArrayCollection();
    }


    public function getBrands(): ArrayCollection
    {
        return $this->brands;
    }

    public function setBrands(ArrayCollection $brands): SneakerFilter
    {
        $this->brands = $brands;
        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): SneakerFilter
    {
        $this->size = $size;
        return $this;
    }


}