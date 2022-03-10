<?php

namespace App\Entity;

use App\Repository\WeaponsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeaponsRepository::class)
 */
class Weapons
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
    private $weapon_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weapon_image;

    /**
     * @ORM\Column(type="text")
     */
    private $weapon_description;

    /**
     * @ORM\OneToOne(targetEntity=Killers::class, cascade={"persist", "remove"})
     */
    private $weapons_killer_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeaponName(): ?string
    {
        return $this->weapon_name;
    }

    public function setWeaponName(string $weapon_name): self
    {
        $this->weapon_name = $weapon_name;

        return $this;
    }

    public function getWeaponImage(): ?string
    {
        return $this->weapon_image;
    }

    public function setWeaponImage(string $weapon_image): self
    {
        $this->weapon_image = $weapon_image;

        return $this;
    }

    public function getWeaponDescription(): ?string
    {
        return $this->weapon_description;
    }

    public function setWeaponDescription(string $weapon_description): self
    {
        $this->weapon_description = $weapon_description;

        return $this;
    }

    public function getWeaponsKillerId(): ?Killers
    {
        return $this->weapons_killer_id;
    }

    public function setWeaponsKillerId(?Killers $weapons_killer_id): self
    {
        $this->weapons_killer_id = $weapons_killer_id;

        return $this;
    }
}
