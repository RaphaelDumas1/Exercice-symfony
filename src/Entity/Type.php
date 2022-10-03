<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $endurance_defaut = null;

    #[ORM\Column]
    private ?int $agilite_defaut = null;

    #[ORM\Column]
    private ?int $intelligence_defaut = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEnduranceDefaut(): ?int
    {
        return $this->endurance_defaut;
    }

    public function setEnduranceDefaut(int $endurance_defaut): self
    {
        $this->endurance_defaut = $endurance_defaut;

        return $this;
    }

    public function getAgiliteDefaut(): ?int
    {
        return $this->agilite_defaut;
    }

    public function setAgiliteDefaut(int $agilite_defaut): self
    {
        $this->agilite_defaut = $agilite_defaut;

        return $this;
    }

    public function getIntelligenceDefaut(): ?int
    {
        return $this->intelligence_defaut;
    }

    public function setIntelligenceDefaut(int $intelligence_defaut): self
    {
        $this->intelligence_defaut = $intelligence_defaut;

        return $this;
    }
}
