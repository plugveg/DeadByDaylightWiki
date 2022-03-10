<?php

namespace App\Entity;

use App\Repository\MapsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapsRepository::class)
 */
class Maps
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
    private $map_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $map_image;

    /**
     * @ORM\Column(type="text")
     */
    private $map_description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $map_layout;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMapName(): ?string
    {
        return $this->map_name;
    }

    public function setMapName(string $map_name): self
    {
        $this->map_name = $map_name;

        return $this;
    }

    public function getMapImage(): ?string
    {
        return $this->map_image;
    }

    public function setMapImage(?string $map_image): self
    {
        $this->map_image = $map_image;

        return $this;
    }

    public function getMapDescription(): ?string
    {
        return $this->map_description;
    }

    public function setMapDescription(string $map_description): self
    {
        $this->map_description = $map_description;

        return $this;
    }

    public function getMapLayout(): ?string
    {
        return $this->map_layout;
    }

    public function setMapLayout(?string $map_layout): self
    {
        $this->map_layout = $map_layout;

        return $this;
    }

}
