<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{

    const STATE = [
        0 => 'pas en prod',
        1 => 'en cours de prod',
        2 => 'prod terminée'
    ];

    const STATEDELIVERY = [
        0 => 'pas encore livré',
        1 => 'en cours de livraison',
        2 => 'livraison terminée'
    ];


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $client = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Article $articles = null;

    #[ORM\Column(length: 2)]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    #[Assert\Length(
        max: 2,
        maxMessage: 'Cette valeur est trop longue. Elle doit contenir au maximum 2 caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    private ?string $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $dateDelivery = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $dateStartProd = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $dateEndProd = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $dateStartDelivery = null;

    #[ORM\Column(length: 8, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    #[Assert\Length(
        exactly: 8,
        exactMessage: 'Le code machine entrée n\'est pas conforme. Il doit contenir exactement 8 caractères',
    )]
    private ?string $trackingNumber = null;

    #[ORM\Column(length: 2, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    #[Assert\Length(
        min: 1,
        max: 2,
        minMessage: 'Cette valeur est trop courte. Elle doit contenir au minimum 1 caractère',
        maxMessage: 'Cette valeur est trop longue. Elle doit contenir au maximum caractères',
    )]
    private ?string $weight = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = "0";

    #[ORM\Column(length: 14, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    #[Assert\Length(
        exactly: 14,
        exactMessage: 'Le numéros de SIRET entrée n\'est pas conforme. Il doit contenir exactement 14 caractères',
    )]
    private ?string $siret = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i',
        htmlPattern: '^[a-zA-Z]+$',
        message: 'Cette valeur ne doit pas contenir de chiffres ou d\'espace'
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Votre nom est trop court. Il doit contenir au minimum 3 caractères',
        maxMessage: 'Votre nom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i',
        htmlPattern: '^[a-zA-Z]+$',
        message: 'Cette valeur ne doit pas contenir de chiffres ou d\'espace'
    )]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Votre prénom est trop court. Il doit contenir au minimum 3 caractères',
        maxMessage: 'Votre prénom est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 10,
        max: 50,
        minMessage: 'Le nom de votre adresse est trop court. Il doit contenir au minimum 10 caractères',
        maxMessage: 'Le nom de votre adresse est trop long. Il doit contenir au maximum 50 caractères',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    #[Assert\Length(
        exactly: 5,
        exactMessage: 'Le code postale entrée n\'est pas conforme. Il doit contenir exactement 5 caractères',
    )]
    private ?string $postalCode = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i',
        htmlPattern: '^[a-zA-Z]+$',
        message: 'Cette valeur ne doit pas contenir de chiffres'
    )]
    #[Assert\Length(
        min: 4,
        max: 20,
        minMessage: 'Le nom de votre ville est trop court. Il doit contenir au minimum 4 caractères',
        maxMessage: 'Le nom de votre ville est trop long. Il doit contenir au maximum 20 caractères',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $stateDelivery = "0";

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Date()]
    private ?string $dateEndDelivery = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Email()]
    #[Assert\Length(
        min: 4,
        max: 50,
        minMessage: 'Votre adresse mail est trop courte. Elle doit contenir au minimum 4 caractères',
        maxMessage: 'Votre adresse mail est trop longue. Elle doit contenir au maximum 50 caractères',
    )]
    private ?string $Email = null;

    #[ORM\Column(length: 10, nullable: true)]
    #[Assert\Regex(
        pattern: '/^(0)[1-9](\d{2}){4}+$/i',
        message: 'Votre nuémros n\'est pas valide ou ne contient pas que des chiffres'
    )]
    private ?string $phoneNumber = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/i',
        message: 'Cette valeur doit uniquement contenir des chiffres'
    )]
    #[Assert\Length(
        max: 2,
        maxMessage: 'Votre prix est trop long. Il doit contenir au maximum 3 caractères',
    )]
    private ?float $unitPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $TVAPrice = 1.20;

    #[ORM\Column(nullable: true)]
    private ?float $TTCPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalTVAPrice = null;


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

    public function getStateType(): string
    {
        return self::STATE[$this->state];
    }

    public function getStateDelivery(): ?string
    {
        return $this->stateDelivery;
    }

    public function setStateDelivery(?string $stateDelivery): self
    {
        $this->stateDelivery = $stateDelivery;

        return $this;
    }

    public function getStateDeliveryType(): string
    {
        return self::STATEDELIVERY[$this->stateDelivery];
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

    public function getDateEndDelivery(): ?string
    {
        return $this->dateEndDelivery;
    }

    public function setDateEndDelivery(?string $dateEndDelivery): self
    {
        $this->dateEndDelivery = $dateEndDelivery;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getTVAPrice(): ?float
    {
        return $this->TVAPrice;
    }

    public function setTVAPrice(?float $TVAPrice): self
    {
        $this->TVAPrice = $TVAPrice;

        return $this;
    }

    public function getTTCPrice(): ?float
    {
        return $this->TTCPrice;
    }

    public function setTTCPrice(?float $TTCPrice): self
    {
        $this->TTCPrice = $TTCPrice;

        return $this;
    }

    public function getTotalTVAPrice(): ?float
    {
        return $this->totalTVAPrice;
    }

    public function setTotalTVAPrice(?float $totalTVAPrice): self
    {
        $this->totalTVAPrice = $totalTVAPrice;

        return $this;
    }

    #[ORM\PrePersist()]
    #[ORM\PreUpdate()]
    public function updateTotalPrice()
    {
        $this->totalPrice = $this->articles->getPrice() * $this->quantity;
    }

    #[ORM\PrePersist()]
    #[ORM\PreUpdate()]
    public function updateTTCPrice()
    {
        $this->TTCPrice = $this->totalPrice * $this->TVAPrice;
    }

    #[ORM\PrePersist()]
    #[ORM\PreUpdate()]
    public function updateTotalTVAPrice()
    {
        $this->totalTVAPrice = $this->TTCPrice - $this->totalPrice;
    }
}
