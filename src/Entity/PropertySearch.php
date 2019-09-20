<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Ajouté pour validation de formulaire


/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertySearchRepository")
 */
class PropertySearch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(min=10, max=400)
     */
    private $minSurface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxSurface;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(?int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    public function getMaxSurface(): ?int
    {
        return $this->maxSurface;
    }

    public function setMaxSurface(?int $maxSurface): self
    {
        $this->maxSurface = $maxSurface;

        return $this;
    }
}
