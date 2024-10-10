<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Trait\SlugTrait;
use App\Repository\BrandsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: BrandsRepository::class)]
#[Vich\Uploadable]
#[ApiResource(
    operations: [
        new GetCollection(normalizationContext: ['groups' => 'brand:list'])
    ],
    order: ['name' => 'DESC'],
    paginationEnabled: false,
)]
class Brands
{
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['brand:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['brand:list'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'brands', targetEntity: Models::class)]
    private Collection $models;

    #[Vich\UploadableField(mapping: 'brands', fileNameProperty: 'imageName')]
    #[Assert\File(
        extensions: ['jpg', 'jpeg', 'png'],
        extensionsMessage: 'Veuillez insérer une image valide, s`\'il vous plaît.',
    )]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->models = new ArrayCollection();
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

    /**
     * @return Collection<int, Models>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Models $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setBrands($this);
        }

        return $this;
    }

    public function removeModel(Models $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getBrands() === $this) {
                $model->setBrands(null);
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

}
