<?php

namespace App\Entity;

use App\Repository\SliderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SliderRepository::class)]
class Slider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnregistrement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->dateEnregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $dateEnregistrement): static
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }
}
