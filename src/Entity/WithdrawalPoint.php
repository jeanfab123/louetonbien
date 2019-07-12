<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WithdrawalPointRepository")
 */
class WithdrawalPoint
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="withdrawalPoints")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $furtherInformation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Item", mappedBy="withdrawalPoint")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WithdrawalPointDayHour", mappedBy="withdrawalPoint", orphanRemoval=true)
     */
    private $withdrawalPointDayHours;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->withdrawalPointDayHours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getFurtherInformation(): ?string
    {
        return $this->furtherInformation;
    }

    public function setFurtherInformation(?string $furtherInformation): self
    {
        $this->furtherInformation = $furtherInformation;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->addWithdrawalPoint($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $item->removeWithdrawalPoint($this);
        }

        return $this;
    }

    /**
     * @return Collection|WithdrawalPointDayHour[]
     */
    public function getWithdrawalPointDayHours(): Collection
    {
        return $this->withdrawalPointDayHours;
    }

    public function addWithdrawalPointDayHour(WithdrawalPointDayHour $withdrawalPointDayHour): self
    {
        if (!$this->withdrawalPointDayHours->contains($withdrawalPointDayHour)) {
            $this->withdrawalPointDayHours[] = $withdrawalPointDayHour;
            $withdrawalPointDayHour->setWithdrawalPoint($this);
        }

        return $this;
    }

    public function removeWithdrawalPointDayHour(WithdrawalPointDayHour $withdrawalPointDayHour): self
    {
        if ($this->withdrawalPointDayHours->contains($withdrawalPointDayHour)) {
            $this->withdrawalPointDayHours->removeElement($withdrawalPointDayHour);
            // set the owning side to null (unless already changed)
            if ($withdrawalPointDayHour->getWithdrawalPoint() === $this) {
                $withdrawalPointDayHour->setWithdrawalPoint(null);
            }
        }

        return $this;
    }
}
