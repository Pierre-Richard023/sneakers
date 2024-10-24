<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Trait\SlugTrait;
use App\Filter\BrandFilter;
use App\Repository\SneakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: SneakerRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'sneaker:item']),
        new GetCollection(normalizationContext: ['groups' => 'sneaker:list'])
    ],
    order: ['release_date' => 'desc'],
    paginationItemsPerPage: 12,
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'shoe_size' => 'exact',
        'color' => 'exact',
        'brand' => 'exact'
    ]
)]
//#[ApiFilter(BrandFilter::class, properties: ["brands"])]
#[ApiFilter(
    OrderFilter::class, properties: ['price', 'date'], arguments: ['orderParameterName' => 'order']
)]
#[Vich\Uploadable]
class Sneaker
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?string $name = null;

    #[Vich\UploadableField(mapping: 'sneakerProfiles', fileNameProperty: 'imageName')]
    #[Assert\File(
        extensions: ['jpg', 'jpeg', 'png'],
        extensionsMessage: 'Veuillez insérer une image valide, s`\'il vous plaît.',
    )]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?float $price = null;

    #[ORM\Column(length: 40)]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?string $article_number = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private ?string $details = null;

    #[ORM\OneToMany(mappedBy: 'sneaker', targetEntity: SneakersImages::class, orphanRemoval: true, cascade: ["persist"])]
    #[Groups(['sneaker:list', 'sneaker:item'])]
    private Collection $images;

    /**
     * @var Collection<int, SneakerSizeStock>
     */
    #[ORM\OneToMany(mappedBy: 'sneaker', targetEntity: SneakerSizeStock::class, orphanRemoval: true)]
    private Collection $sneakerSizeStocks;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brands $brand = null;

    #[ORM\Column(length: 100)]
    private ?string $color = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->sneakerSizeStocks = new ArrayCollection();
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

    public function getArticleNumber(): ?string
    {
        return $this->article_number;
    }

    public function setArticleNumber(string $article_number): static
    {
        $this->article_number = $article_number;

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

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    #[Groups(['sneaker:list', 'sneaker:item'])]
    public function getProfileImageUrl(): ?string
    {
        if ($this->imageName) {
            return '/images/sneakers/' . $this->imageName;
        }

        return null;
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
            $sneakerSizeStock->setSneaker($this);
        }

        return $this;
    }

    public function removeSneakerSizeStock(SneakerSizeStock $sneakerSizeStock): static
    {
        if ($this->sneakerSizeStocks->removeElement($sneakerSizeStock)) {
            // set the owning side to null (unless already changed)
            if ($sneakerSizeStock->getSneaker() === $this) {
                $sneakerSizeStock->setSneaker(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?Brands
    {
        return $this->brand;
    }

    public function setBrand(?Brands $brand): static
    {
        $this->brand = $brand;

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
}
