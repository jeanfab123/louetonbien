<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\EntitySlugTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 * @UniqueEntity("name")
 * @UniqueEntity("subtitle")
 * @ORM\HasLifecycleCallbacks()
 */
class Item
{

    use EntitySlugTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="items")
     */
    private $category;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="item")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $depositAmount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $similarItemsNumber;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PickupPoint", inversedBy="items")
     */
    private $pickupPoint;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Price", mappedBy="item", orphanRemoval=true)
     */
    private $prices;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $viewsNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $enabledAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disabledAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="item")
     */
    private $rentals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="item")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserUnavailableDate", mappedBy="item")
     */
    private $userUnavailableDates;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->generateSlug($this->name);
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
        $this->category = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->pickupPoint = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->rentals = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->userUnavailableDates = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addItem($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeItem($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getDepositAmount(): ?int
    {
        return $this->depositAmount;
    }

    public function setDepositAmount(?int $depositAmount): self
    {
        $this->depositAmount = $depositAmount;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getSimilarItemsNumber(): ?int
    {
        return $this->similarItemsNumber;
    }

    public function setSimilarItemsNumber(?int $similarItemsNumber): self
    {
        $this->similarItemsNumber = $similarItemsNumber;

        return $this;
    }

    /**
     * @return Collection|pickupPoint[]
     */
    public function getPickupPoint(): Collection
    {
        return $this->pickupPoint;
    }

    public function addPickupPoint(pickupPoint $pickupPoint): self
    {
        if (!$this->pickupPoint->contains($pickupPoint)) {
            $this->pickupPoint[] = $pickupPoint;
        }

        return $this;
    }

    public function removePickupPoint(pickupPoint $pickupPoint): self
    {
        if ($this->pickupPoint->contains($pickupPoint)) {
            $this->pickupPoint->removeElement($pickupPoint);
        }

        return $this;
    }

    /**
     * @return Collection|Price[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setItem($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            // set the owning side to null (unless already changed)
            if ($price->getItem() === $this) {
                $price->setItem(null);
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

    public function getViewsNumber(): ?int
    {
        return $this->viewsNumber;
    }

    public function setViewsNumber(?int $viewsNumber): self
    {
        $this->viewsNumber = $viewsNumber;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabledAt(): ?\DateTimeInterface
    {
        return $this->enabledAt;
    }

    public function setEnabledAt(?\DateTimeInterface $enabledAt): self
    {
        $this->enabledAt = $enabledAt;

        return $this;
    }

    public function getDisabledAt(): ?\DateTimeInterface
    {
        return $this->disabledAt;
    }

    public function setDisabledAt(?\DateTimeInterface $disabledAt): self
    {
        $this->disabledAt = $disabledAt;

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
            $rental->setItem($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->contains($rental)) {
            $this->rentals->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getItem() === $this) {
                $rental->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setItem($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getItem() === $this) {
                $message->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserUnavailableDate[]
     */
    public function getUserUnavailableDates(): Collection
    {
        return $this->userUnavailableDates;
    }

    public function addUserUnavailableDate(UserUnavailableDate $userUnavailableDate): self
    {
        if (!$this->userUnavailableDates->contains($userUnavailableDate)) {
            $this->userUnavailableDates[] = $userUnavailableDate;
            $userUnavailableDate->setItem($this);
        }

        return $this;
    }

    public function removeUserUnavailableDate(UserUnavailableDate $userUnavailableDate): self
    {
        if ($this->userUnavailableDates->contains($userUnavailableDate)) {
            $this->userUnavailableDates->removeElement($userUnavailableDate);
            // set the owning side to null (unless already changed)
            if ($userUnavailableDate->getItem() === $this) {
                $userUnavailableDate->setItem(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
