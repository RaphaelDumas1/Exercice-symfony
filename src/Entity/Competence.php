<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $decription = null;

    #[ORM\Column(nullable: true)]
    private ?int $degat = null;

    #[ORM\Column(nullable: true)]
    private ?bool $stun = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDecription(): ?string
    {
        return $this->decription;
    }

    public function setDecription(string $decription): self
    {
        $this->decription = $decription;

        return $this;
    }

    public function getDegat(): ?int
    {
        return $this->degat;
    }

    public function setDegat(?int $degat): self
    {
        $this->degat = $degat;

        return $this;
    }

    public function isStun(): ?bool
    {
        return $this->stun;
    }

    public function setStun(?bool $stun): self
    {
        $this->stun = $stun;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
