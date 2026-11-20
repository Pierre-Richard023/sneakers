<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Repository\ShippingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ],
    normalizationContext: ['groups' => ['read:transporter']],
    denormalizationContext: ['groups' => ['write:transporter']],
)]
#[ORM\Entity(repositoryClass: ShippingRepository::class)]
class Transporter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:transporter'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:transporter', 'write:transporter'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read:transporter', 'write:transporter'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['read:transporter', 'write:transporter'])]
    private ?float $price = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function __toString(): string
    {
        return $this->name . '[-br]'
            . $this->description . '[-br]'
            . $this->price . ' €';
    }
}
