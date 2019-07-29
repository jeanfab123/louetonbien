<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntitySlugTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PickupPointRepository")
 * @UniqueEntity("code")
 * @ORM\HasLifecycleCallbacks()
 */
class PickupPoint
{

    use EntitySlugTrait;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pickupPoints")
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Item", mappedBy="pickupPoint")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PickupPointDayHour", mappedBy="pickupPoint", orphanRemoval=true)
     */
    private $pickupPointDayHours;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="pickupPoint")
     */
    private $rentals;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->generateSlug($this->user->getUsername());
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeDatasBeforeUpdate()
    {
        $this->modifiedAt = new \DateTime();
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->pickupPointDayHours = new ArrayCollection();
        $this->rentals = new ArrayCollection();
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
            $item->addPickupPoint($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            $item->removePickupPoint($this);
        }

        return $this;
    }

    /**
     * @return Collection|PickupPointDayHour[]
     */
    public function getPickupPointDayHours(): Collection
    {
        return $this->pickupPointDayHours;
    }

    public function addPickupPointDayHour(PickupPointDayHour $pickupPointDayHour): self
    {
        if (!$this->pickupPointDayHours->contains($pickupPointDayHour)) {
            $this->pickupPointDayHours[] = $pickupPointDayHour;
            $pickupPointDayHour->setPickupPoint($this);
        }

        return $this;
    }

    public function removePickupPointDayHour(PickupPointDayHour $pickupPointDayHour): self
    {
        if ($this->pickupPointDayHours->contains($pickupPointDayHour)) {
            $this->pickupPointDayHours->removeElement($pickupPointDayHour);
            // set the owning side to null (unless already changed)
            if ($pickupPointDayHour->getPickupPoint() === $this) {
                $pickupPointDayHour->setPickupPoint(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * @return Collection|Rental[]
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): self
    {
        if (!$this->rentals->contains($rental)) {
            $this->rentals[] = $rental;
            $rental->setPickupPoint($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->contains($rental)) {
            $this->rentals->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getPickupPoint() === $this) {
                $rental->setPickupPoint(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
