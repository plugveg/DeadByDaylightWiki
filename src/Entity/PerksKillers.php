<?php

/*Info sur le current directory*/
namespace App\Entity;

/*Permet l'importation des différents Repository*/
use App\Repository\PerksKillersRepository;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerksKillersRepository::class)
 */
class PerksKillers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $perkkiller_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $perkkiller_image;

    /**
     * @ORM\Column(type="text")
     */
    private $perkkiller_explanation;

    /**
     * @ORM\ManyToOne(targetEntity=Killers::class, inversedBy="killer_perks")
     */
    private $perk_killer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerkkillerName(): ?string
    {
        return $this->perkkiller_name;
    }

    public function setPerkkillerName(string $perkkiller_name): self
    {
        $this->perkkiller_name = $perkkiller_name;

        return $this;
    }

    public function getPerkkillerImage(): ?string
    {
        return $this->perkkiller_image;
    }

    public function setPerkkillerImage(?string $perkkiller_image): self
    {
        $this->perkkiller_image = $perkkiller_image;

        return $this;
    }

    public function getPerkkillerExplanation(): ?string
    {
        return $this->perkkiller_explanation;
    }

    public function setPerkkillerExplanation(string $perkkiller_explanation): self
    {
        $this->perkkiller_explanation = $perkkiller_explanation;

        return $this;
    }

    public function getPerkKiller(): ?Killers
    {
        return $this->perk_killer;
    }

    public function setPerkKiller(?Killers $perk_killer): self
    {
        $this->perk_killer = $perk_killer;

        return $this;
    }
}
