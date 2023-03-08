<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $refFilm = null;

    #[ORM\Column(length: 255)]
    private ?string $codeMachine = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $cretaedAt = null;

    public function __construct()
    {
        $this->cretaedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRefFilm(): ?string
    {
        return $this->refFilm;
    }

    public function setRefFilm(string $refFilm): self
    {
        $this->refFilm = $refFilm;

        return $this;
    }

    public function getCodeMachine(): ?string
    {
        return $this->codeMachine;
    }

    public function setCodeMachine(string $codeMachine): self
    {
        $this->codeMachine = $codeMachine;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCretaedAt(): ?\DateTimeImmutable
    {
        return $this->cretaedAt;
    }

    public function setCretaedAt(\DateTimeImmutable $cretaedAt): self
    {
        $this->cretaedAt = $cretaedAt;

        return $this;
    }
}
