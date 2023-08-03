<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\SneakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SneakerRepository::class)]
class Sneaker
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 40)]
    private ?string $article_number = null;

    #[ORM\Column]
    private ?float $shoe_size;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\OneToMany(mappedBy: 'sneaker', targetEntity: SneakersImages::class, orphanRemoval: true, cascade : ["persist"])]
    private Collection $images;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Models $model = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getArticleNumber(): ?string
    {
        return $this->article_number;
    }

    public function setArticleNumber(string $article_number): static
    {
        $this->article_number = $article_number;

        return $this;
    }

    public function getShoeSize(): ?float
    {
        return $this->shoe_size;
    }

    public function setShoeSize(float $shoe_size): static
    {
        $this->shoe_size = $shoe_size;

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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return Collection<int, SneakersImages>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(SneakersImages $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setSneaker($this);
        }

        return $this;
    }

    public function removeImage(SneakersImages $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getSneaker() === $this) {
                $image->setSneaker(null);
            }
        }

        return $this;
    }

    public function getModel(): ?Models
    {
        return $this->model;
    }

    public function setModel(?Models $model): static
    {
        $this->model = $model;

        return $this;
    }
}
