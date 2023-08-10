<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups'=>'address:item']),
        new GetCollection(normalizationContext: ['groups'=>'address:list'])
    ],
    order: ['id'=>'DESC'],
    paginationEnabled: false,
)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $company_name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $additional_address = null;

    #[ORM\Column(length: 5)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $postal_code = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $country = null;

    #[ORM\Column(length: 20)]
    #[Groups(['user:list', 'user:item','address:list', 'address:item'])]
    private ?string $phone_number = null;

    #[ORM\ManyToOne(inversedBy: 'delivery_address')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(?string $company_name): static
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getAdditionalAddress(): ?string
    {
        return $this->additional_address;
    }

    public function setAdditionalAddress(?string $additional_address): static
    {
        $this->additional_address = $additional_address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }


        public function __toString(): string
        {
            $res = $this->first_name . ' ' . $this->last_name . '[-br]'
                . $this->address . '[-br]';

            if ($this->additional_address)
                $res .= $this->additional_address . '[-br]';

            if ($this->company_name)
                $res .= $this->company_name . '[-br]';

            $res .= $this->city . ' ' . $this->postal_code . '[-br]'
                . $this->country . '[-br]'
                . $this->phone_number;


            return $res;
        }
}
