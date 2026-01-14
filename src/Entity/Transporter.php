<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ShippingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ShippingRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'transporter:item']),
        new GetCollection(normalizationContext: ['groups' => 'transporter:list'])
    ],
    order: ['id' => 'DESC'],
    paginationEnabled: false,
)]
class Transporter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['transporter:list', 'transporter:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['transporter:list', 'transporter:item'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['transporter:list', 'transporter:item'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['transporter:list', 'transporter:item'])]
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
