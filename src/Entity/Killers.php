<?php

namespace App\Entity;

use App\Repository\KillersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KillersRepository::class)
 */
class Killers
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
    private $killer_nickname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $killer_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $killer_image;

    /**
     * @ORM\OneToOne(targetEntity=Maps::class, cascade={"persist", "remove"})
     */
    private $killer_map;

    /**
     * @ORM\OneToOne(targetEntity=Weapons::class, cascade={"persist", "remove"})
     */
    private $killer_weapon;

    /**
     * @ORM\OneToOne(targetEntity=Powers::class, cascade={"persist", "remove"})
     */
    private $killer_power;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $killer_speed;

    /**
     * @ORM\OneToMany(targetEntity=PerksKillers::class, mappedBy="perk_killer")
     */
    private $killer_perks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $killer_summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $killer_history;

    public function __construct()
    {
        $this->killer_perks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKillerNickname(): ?string
    {
        return $this->killer_nickname;
    }

    public function setKillerNickname(string $killer_nickname): self
    {
        $this->killer_nickname = $killer_nickname;

        return $this;
    }

    public function getKillerName(): ?string
    {
        return $this->killer_name;
    }

    public function setKillerName(string $killer_name): self
    {
        $this->killer_name = $killer_name;

        return $this;
    }

    public function getKillerImage(): ?string
    {
        return $this->killer_image;
    }

    public function setKillerImage(string $killer_image): self
    {
        $this->killer_image = $killer_image;

        return $this;
    }

    public function getKillerMap(): ?Maps
    {
        return $this->killer_map;
    }

    public function setKillerMap(?Maps $killer_map): self
    {
        $this->killer_map = $killer_map;

        return $this;
    }

    public function getKillerWeapon(): ?Weapons
    {
        return $this->killer_weapon;
    }

    public function setKillerWeapon(?Weapons $killer_weapon): self
    {
        $this->killer_weapon = $killer_weapon;

        return $this;
    }

    public function getKillerPower(): ?Powers
    {
        return $this->killer_power;
    }

    public function setKillerPower(?Powers $killer_power): self
    {
        $this->killer_power = $killer_power;

        return $this;
    }

    public function getKillerSpeed(): ?string
    {
        return $this->killer_speed;
    }

    public function setKillerSpeed(string $killer_speed): self
    {
        $this->killer_speed = $killer_speed;

        return $this;
    }

    /**
     * @return Collection|PerksKillers[]
     */
    public function getKillerPerks(): Collection
    {
        return $this->killer_perks;
    }

    public function addKillerPerk(PerksKillers $killerPerk): self
    {
        if (!$this->killer_perks->contains($killerPerk)) {
            $this->killer_perks[] = $killerPerk;
            $killerPerk->setPerkKiller($this);
        }

        return $this;
    }

    public function removeKillerPerk(PerksKillers $killerPerk): self
    {
        if ($this->killer_perks->removeElement($killerPerk)) {
            // set the owning side to null (unless already changed)
            if ($killerPerk->getPerkKiller() === $this) {
                $killerPerk->setPerkKiller(null);
            }
        }

        return $this;
    }

    public function getKillerSummary(): ?string
    {
        return $this->killer_summary;
    }

    public function setKillerSummary(?string $killer_summary): self
    {
        $this->killer_summary = $killer_summary;

        return $this;
    }

    public function getKillerHistory(): ?string
    {
        return $this->killer_history;
    }

    public function setKillerHistory(?string $killer_history): self
    {
        $this->killer_history = $killer_history;

        return $this;
    }
}
