<?php

namespace App\Entity;

use App\Repository\SneakerSizeStockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SneakerSizeStockRepository::class)]
class SneakerSizeStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sneakerSizeStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sneaker $sneaker = null;

    #[ORM\ManyToOne(inversedBy: 'sneakerSizeStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SneakerSize $SneakerSize = null;

    #[ORM\Column]
    private ?int $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSneaker(): ?Sneaker
    {
        return $this->sneaker;
    }

    public function setSneaker(?Sneaker $sneaker): static
    {
        $this->sneaker = $sneaker;

        return $this;
    }

    public function getSneakerSize(): ?SneakerSize
    {
        return $this->SneakerSize;
    }

    public function setSneakerSize(?SneakerSize $SneakerSize): static
    {
        $this->SneakerSize = $SneakerSize;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
