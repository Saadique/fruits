<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $sourceId = null;

    #[ORM\Column(length: 30)]
    private ?string $family = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $fruitOrder = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $genus = null;

    #[ORM\Column]
    private array $nutritions = [];

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

    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->sourceId = $sourceId;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getFruitOrder(): ?string
    {
        return $this->fruitOrder;
    }

    public function setFruitOrder(?string $fruitOrder): self
    {
        $this->fruitOrder = $fruitOrder;

        return $this;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(?string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getNutritions(): array
    {
        return $this->nutritions;
    }

    public function setNutritions(array $nutritions): self
    {
        $this->nutritions = $nutritions;

        return $this;
    }
}
