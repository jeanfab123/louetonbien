<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntitySlugTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RentalRepository")
 */
class Rental
{

    use EntitySlugTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="rentals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="rentals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $state;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $validatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cancelledAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realItemName;

    /**
     * @ORM\Column(type="text")
     */
    private $realItemDescription;

    /**
     * @ORM\Column(type="integer")
     */
    private $realItemDepositAmount;

    /**
     * @ORM\Column(type="float")
     */
    private $realItemPrice;

    /**
     * @ORM\Column(type="array")
     */
    private $realItemAllPrices = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\pickupPoint", inversedBy="rentals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pickupPoint;

    /**
     * @ORM\Column(type="object")
     */
    private $realPickupPoint;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="renterRentals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tenantComment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="rental")
     */
    private $ratings;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->generateCode(
            $this->getTenant()->getUsername() . $this->getRenter()->getUsername()
        );
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getTenant(): ?User
    {
        return $this->tenant;
    }

    public function setTenant(?User $tenant): self
    {
        $this->tenant = $tenant;

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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getValidatedAt(): ?\DateTimeInterface
    {
        return $this->validatedAt;
    }

    public function setValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $this->validatedAt = $validatedAt;

        return $this;
    }

    public function getCancelledAt(): ?\DateTimeInterface
    {
        return $this->cancelledAt;
    }

    public function setCancelledAt(?\DateTimeInterface $cancelledAt): self
    {
        $this->cancelledAt = $cancelledAt;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

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

    public function getRealItemName(): ?string
    {
        return $this->realItemName;
    }

    public function setRealItemName(string $realItemName): self
    {
        $this->realItemName = $realItemName;

        return $this;
    }

    public function getRealItemDescription(): ?string
    {
        return $this->realItemDescription;
    }

    public function setRealItemDescription(string $realItemDescription): self
    {
        $this->realItemDescription = $realItemDescription;

        return $this;
    }

    public function getRealItemDepositAmount(): ?int
    {
        return $this->realItemDepositAmount;
    }

    public function setRealItemDepositAmount(int $realItemDepositAmount): self
    {
        $this->realItemDepositAmount = $realItemDepositAmount;

        return $this;
    }

    public function getRealItemPrice(): ?float
    {
        return $this->realItemPrice;
    }

    public function setRealItemPrice(float $realItemPrice): self
    {
        $this->realItemPrice = $realItemPrice;

        return $this;
    }

    public function getRealItemAllPrices(): ?array
    {
        return $this->realItemAllPrices;
    }

    public function setRealItemAllPrices(array $realItemAllPrices): self
    {
        $this->realItemAllPrices = $realItemAllPrices;

        return $this;
    }

    public function getPickupPoint(): ?pickupPoint
    {
        return $this->pickupPoint;
    }

    public function setPickupPoint(?pickupPoint $pickupPoint): self
    {
        $this->pickupPoint = $pickupPoint;

        return $this;
    }

    public function getRealPickupPoint()
    {
        return $this->realPickupPoint;
    }

    public function setRealPickupPoint($realPickupPoint): self
    {
        $this->realPickupPoint = $realPickupPoint;

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

    public function getRenter(): ?User
    {
        return $this->renter;
    }

    public function setRenter(?User $renter): self
    {
        $this->renter = $renter;

        return $this;
    }

    public function getTenantComment(): ?string
    {
        return $this->tenantComment;
    }

    public function setTenantComment(?string $tenantComment): self
    {
        $this->tenantComment = $tenantComment;

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setRental($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->contains($rating)) {
            $this->ratings->removeElement($rating);
            // set the owning side to null (unless already changed)
            if ($rating->getRental() === $this) {
                $rating->setRental(null);
            }
        }

        return $this;
    }
}
