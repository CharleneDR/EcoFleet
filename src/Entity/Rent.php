<?php

namespace App\Entity;

use App\Repository\RentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentRepository::class)]
class Rent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $locationDeparture = null;

    #[ORM\Column(length: 255)]
    private ?string $locationArrival = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToMany(targetEntity: Employee::class, inversedBy: 'rents')]
    private Collection $employee;

    #[ORM\ManyToOne(inversedBy: 'rents')]
    private ?Car $car = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'travels')]
    private Collection $passenger;

    public function __construct()
    {
        $this->employee = new ArrayCollection();
        $this->passenger = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocationDeparture(): ?string
    {
        return $this->locationDeparture;
    }

    public function setLocationDeparture(string $locationDeparture): self
    {
        $this->locationDeparture = $locationDeparture;

        return $this;
    }

    public function getLocationArrival(): ?string
    {
        return $this->locationArrival;
    }

    public function setLocationArrival(string $locationArrival): self
    {
        $this->locationArrival = $locationArrival;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployee(): Collection
    {
        return $this->employee;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employee->contains($employee)) {
            $this->employee->add($employee);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        $this->employee->removeElement($employee);

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPassenger(): Collection
    {
        return $this->passenger;
    }

    public function addPassenger(User $passenger): self
    {
        if (!$this->passenger->contains($passenger)) {
            $this->passenger->add($passenger);
        }

        return $this;
    }

    public function removePassenger(User $passenger): self
    {
        $this->passenger->removeElement($passenger);

        return $this;
    }
}
