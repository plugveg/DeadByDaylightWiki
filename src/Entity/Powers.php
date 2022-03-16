<?php

/*Info sur le current directory*/
namespace App\Entity;

/*Permet l'importation des différents Repository*/
use App\Repository\PowersRepository;
/*Les use nécessaires pour lancer le code*/
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PowersRepository::class)
 */
class Powers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $power_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $power_image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $power_description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $power_explanation;

    /**
     * @ORM\OneToOne(targetEntity=Killers::class, cascade={"persist", "remove"})
     */
    private $power_killer_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPowerName(): ?string
    {
        return $this->power_name;
    }

    public function setPowerName(string $power_name): self
    {
        $this->power_name = $power_name;

        return $this;
    }

    public function getPowerImage(): ?string
    {
        return $this->power_image;
    }

    public function setPowerImage(string $power_image): self
    {
        $this->power_image = $power_image;

        return $this;
    }

    public function getPowerDescription(): ?string
    {
        return $this->power_description;
    }

    public function setPowerDescription(?string $power_description): self
    {
        $this->power_description = $power_description;

        return $this;
    }

    public function getPowerExplanation(): ?string
    {
        return $this->power_explanation;
    }

    public function setPowerExplanation(?string $power_explanation): self
    {
        $this->power_explanation = $power_explanation;

        return $this;
    }

    public function getPowerKillerId(): ?Killers
    {
        return $this->power_killer_id;
    }

    public function setPowerKillerId(?Killers $power_killer_id): self
    {
        $this->power_killer_id = $power_killer_id;

        return $this;
    }
}
