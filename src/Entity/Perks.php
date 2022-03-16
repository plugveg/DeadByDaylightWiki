<?php

/*Info sur le current directory*/
namespace App\Entity;

/*Permet l'importation des différents Repository*/
use App\Repository\PerksRepository;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerksRepository::class)
 */
class Perks
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
    private $perk_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $perk_image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perk_explanation;

    /**
     * @ORM\ManyToOne(targetEntity=Survivors::class, inversedBy="survivor_perk1")
     */
    private $perk_survivor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerkName(): ?string
    {
        return $this->perk_name;
    }

    public function setPerkName(string $perk_name): self
    {
        $this->perk_name = $perk_name;

        return $this;
    }

    public function getPerkImage(): ?string
    {
        return $this->perk_image;
    }

    public function setPerkImage(string $perk_image): self
    {
        $this->perk_image = $perk_image;

        return $this;
    }

    public function getPerkExplanation(): ?string
    {
        return $this->perk_explanation;
    }

    public function setPerkExplanation(?string $perk_explanation): self
    {
        $this->perk_explanation = $perk_explanation;

        return $this;
    }

    public function getPerkSurvivor(): ?Survivors
    {
        return $this->perk_survivor;
    }

    public function setPerkSurvivor(?Survivors $perk_survivor): self
    {
        $this->perk_survivor = $perk_survivor;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->perk_survivor;
    }


}