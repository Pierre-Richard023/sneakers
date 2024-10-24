<?php

namespace App\Entity;

use App\Repository\SneakerSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SneakerSizeRepository::class)]
class SneakerSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $size = null;

    /**
     * @var Collection<int, SneakerSizeStock>
     */
    #[ORM\OneToMany(mappedBy: 'SneakerSize', targetEntity: SneakerSizeStock::class, orphanRemoval: true)]
    private Collection $sneakerSizeStocks;

    public function __construct()
    {
        $this->sneakerSizeStocks = new ArrayCollection();
    }

    public function getId(): ?float
    {
        return $this->id;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection<int, SneakerSizeStock>
     */
    public function getSneakerSizeStocks(): Collection
    {
        return $this->sneakerSizeStocks;
    }

    public function addSneakerSizeStock(SneakerSizeStock $sneakerSizeStock): static
    {
        if (!$this->sneakerSizeStocks->contains($sneakerSizeStock)) {
            $this->sneakerSizeStocks->add($sneakerSizeStock);
            $sneakerSizeStock->setSneakerSize($this);
        }

        return $this;
    }

    public function removeSneakerSizeStock(SneakerSizeStock $sneakerSizeStock): static
    {
        if ($this->sneakerSizeStocks->removeElement($sneakerSizeStock)) {
            // set the owning side to null (unless already changed)
            if ($sneakerSizeStock->getSneakerSize() === $this) {
                $sneakerSizeStock->setSneakerSize(null);
            }
        }

        return $this;
    }
}
