<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $number = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $customer = null;

    #[ORM\ManyToMany(targetEntity: Sneaker::class)]
    private Collection $sneakers;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Transporter $transporter = null;

    public function __construct()
    {
        $this->sneakers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, Sneaker>
     */
    public function getSneakers(): Collection
    {
        return $this->sneakers;
    }

    public function addSneaker(Sneaker $sneaker): static
    {
        if (!$this->sneakers->contains($sneaker)) {
            $this->sneakers->add($sneaker);
        }

        return $this;
    }

    public function removeSneaker(Sneaker $sneaker): static
    {
        $this->sneakers->removeElement($sneaker);

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getTransporter(): ?Transporter
    {
        return $this->transporter;
    }

    public function setTransporter(?Transporter $transporter): static
    {
        $this->transporter = $transporter;

        return $this;
    }
}
