<?php

/*Info sur le current directory*/
namespace App\Entity;

/*Permet l'importation des différents Repository*/
use App\Repository\SurvivorsRepository;
/*Les use nécessaires pour lancer le code*/
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SurvivorsRepository::class)
 */
class Survivors
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
    private $survivor_name;

    /**
     * @ORM\Column(type="text")
     */
    private $survivor_history;

    /**
     * @ORM\OneToMany(targetEntity=Perks::class, mappedBy="perk_survivor")
     */
    private $survivor_perk1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $survivor_image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $survivor_summary;

    public function __construct()
    {
        $this->survivor_perk1 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurvivorName(): ?string
    {
        return $this->survivor_name;
    }

    public function setSurvivorName(string $survivor_name): self
    {
        $this->survivor_name = $survivor_name;

        return $this;
    }

    public function getSurvivorHistory(): ?string
    {
        return $this->survivor_history;
    }

    public function setSurvivorHistory(string $survivor_history): self
    {
        $this->survivor_history = $survivor_history;

        return $this;
    }

    /**
     * @return Collection|Perks[]
     */
    public function getSurvivorPerk1(): Collection
    {
        return $this->survivor_perk1;
    }

    public function addSurvivorPerk1(Perks $survivorPerk1): self
    {
        if (!$this->survivor_perk1->contains($survivorPerk1)) {
            $this->survivor_perk1[] = $survivorPerk1;
            $survivorPerk1->setPerkSurvivor($this);
        }

        return $this;
    }

    public function removeSurvivorPerk1(Perks $survivorPerk1): self
    {
        if ($this->survivor_perk1->removeElement($survivorPerk1)) {
            // set the owning side to null (unless already changed)
            if ($survivorPerk1->getPerkSurvivor() === $this) {
                $survivorPerk1->setPerkSurvivor(null);
            }
        }

        return $this;
    }

    public function getSurvivorImage(): ?string
    {
        return $this->survivor_image;
    }

    public function setSurvivorImage(?string $survivor_image): self
    {
        $this->survivor_image = $survivor_image;

        return $this;
    }

    public function getSurvivorSummary(): ?string
    {
        return $this->survivor_summary;
    }

    public function setSurvivorSummary(?string $survivor_summary): self
    {
        $this->survivor_summary = $survivor_summary;

        return $this;
    }

   public function setSurvivor(Survivors $survivors): self
   {
       $this->survivor = $survivors;
       return $survivors;
   }

   public function getSurvivor(): Survivors
   {
       return $this->survivor;
   }

}
