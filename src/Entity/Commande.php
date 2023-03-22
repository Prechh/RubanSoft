<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $client = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Article $articles = null;

    #[ORM\Column(length: 255)]
    private ?string $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateDelivery = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateStartProd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateEndProd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dateStartDelivery = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trackingNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weight = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PrePersist()]
    public function setUpdatedValue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getArticles(): ?Article
    {
        return $this->articles;
    }

    public function setArticles(?Article $articles): self
    {
        $this->articles = $articles;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDateDelivery(): ?string
    {
        return $this->dateDelivery;
    }

    public function setDateDelivery(?string $dateDelivery): self
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    public function getDateStartProd(): ?string
    {
        return $this->dateStartProd;
    }

    public function setDateStartProd(?string $dateStartProd): self
    {
        $this->dateStartProd = $dateStartProd;

        return $this;
    }

    public function getDateEndProd(): ?string
    {
        return $this->dateEndProd;
    }

    public function setDateEndProd(?string $dateEndProd): self
    {
        $this->dateEndProd = $dateEndProd;

        return $this;
    }

    public function getDateStartDelivery(): ?string
    {
        return $this->dateStartDelivery;
    }

    public function setDateStartDelivery(?string $dateStartDelivery): self
    {
        $this->dateStartDelivery = $dateStartDelivery;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }
}
