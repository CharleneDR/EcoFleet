<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $fuel = null;

    #[ORM\Column(length: 255)]
    private ?string $geerbox = null;

    #[ORM\Column]
    private ?int $kilometers = null;

    #[ORM\Column]
    private ?int $seats = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agency $city = null;

    #[ORM\Column(length: 255)]
    private ?string $registration = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: UnavailabilityDate::class)]
    private Collection $unavailabilityDates;

    #[ORM\Column]
    private ?bool $Available = null;

    public function __construct()
    {
        $this->rents = new ArrayCollection();
        $this->unavailabilityDates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getGeerbox(): ?string
    {
        return $this->geerbox;
    }

    public function setGeerbox(string $geerbox): self
    {
        $this->geerbox = $geerbox;

        return $this;
    }

    public function getKilometers(): ?int
    {
        return $this->kilometers;
    }

    public function setKilometers(int $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getCity(): ?Agency
    {
        return $this->city;
    }

    public function setCity(?Agency $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    public function setRegistration(string $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return ArrayCollection<int, UnavailabilityDate>
     */
    public function getUnavailabilityDates(): ArrayCollection
    {
        return $this->unavailabilityDates;
    }

    public function addUnavailabilityDate(UnavailabilityDate $unavailabilityDate): self
    {
        if (!$this->unavailabilityDates->contains($unavailabilityDate)) {
            $this->unavailabilityDates->add($unavailabilityDate);
            $unavailabilityDate->setCar($this);
        }

        return $this;
    }

    public function removeUnavailabilityDate(UnavailabilityDate $unavailabilityDate): self
    {
        if ($this->unavailabilityDates->removeElement($unavailabilityDate)) {
            // set the owning side to null (unless already changed)
            if ($unavailabilityDate->getCar() === $this) {
                $unavailabilityDate->setCar(null);
            }
        }

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->Available;
    }

    public function setAvailable(bool $Available): self
    {
        $this->Available = $Available;

        return $this;
    }
}
