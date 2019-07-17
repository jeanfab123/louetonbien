<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\EntitySlugTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 * @UniqueEntity("slug")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface, \Serializable
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tag", mappedBy="user")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="User")
     */
    private $items;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $fixedPhone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $officePhone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PickupPoint", mappedBy="user")
     */
    private $pickupPoints;

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
    private $suspendedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $bannedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $closedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemRequest", mappedBy="user")
     */
    private $itemRequests;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="tenant")
     */
    private $rentals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rental", mappedBy="renter")
     */
    private $renterRentals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="editor")
     */
    private $ratingsAsEditor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="renter")
     */
    private $ratingsAsRenter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rating", mappedBy="tenant")
     */
    private $ratingsAsTenant;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->generateSlug($this->username);
        $this->createdAt = new \DateTime();
        $this->state = 'UNVALIDATED';
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
        $this->tags = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->pickupPoints = new ArrayCollection();
        $this->itemRequests = new ArrayCollection();
        $this->rentals = new ArrayCollection();
        $this->renterRentals = new ArrayCollection();
        $this->ratingsAsEditor = new ArrayCollection();
        $this->ratingsAsRenter = new ArrayCollection();
        $this->ratingsAsTenant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    { }

    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->password
            ]
        );
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

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
            $tag->setUser($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getUser() === $this) {
                $tag->setUser(null);
            }
        }

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
            $item->setUser($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getUser() === $this) {
                $item->setUser(null);
            }
        }

        return $this;
    }

    public function getFixedPhone(): ?string
    {
        return $this->fixedPhone;
    }

    public function setFixedPhone(?string $fixedPhone): self
    {
        $this->fixedPhone = $fixedPhone;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getOfficePhone(): ?string
    {
        return $this->officePhone;
    }

    public function setOfficePhone(?string $officePhone): self
    {
        $this->officePhone = $officePhone;

        return $this;
    }

    /**
     * @return Collection|PickupPoint[]
     */
    public function getPickupPoints(): Collection
    {
        return $this->pickupPoints;
    }

    public function addPickupPoint(PickupPoint $pickupPoint): self
    {
        if (!$this->pickupPoints->contains($pickupPoint)) {
            $this->pickupPoints[] = $pickupPoint;
            $pickupPoint->setUser($this);
        }

        return $this;
    }

    public function removePickupPoint(PickupPoint $pickupPoint): self
    {
        if ($this->pickupPoints->contains($pickupPoint)) {
            $this->pickupPoints->removeElement($pickupPoint);
            // set the owning side to null (unless already changed)
            if ($pickupPoint->getUser() === $this) {
                $pickupPoint->setUser(null);
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

    public function getSuspendedAt(): ?\DateTimeInterface
    {
        return $this->suspendedAt;
    }

    public function setSuspendedAt(?\DateTimeInterface $suspendedAt): self
    {
        $this->suspendedAt = $suspendedAt;

        return $this;
    }

    public function getBannedAt(): ?\DateTimeInterface
    {
        return $this->bannedAt;
    }

    public function setBannedAt(?\DateTimeInterface $bannedAt): self
    {
        $this->bannedAt = $bannedAt;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closedAt;
    }

    public function setClosedAt(?\DateTimeInterface $closedAt): self
    {
        $this->closedAt = $closedAt;

        return $this;
    }

    /**
     * @return Collection|ItemRequest[]
     */
    public function getItemRequests(): Collection
    {
        return $this->itemRequests;
    }

    public function addItemRequest(ItemRequest $itemRequest): self
    {
        if (!$this->itemRequests->contains($itemRequest)) {
            $this->itemRequests[] = $itemRequest;
            $itemRequest->setUser($this);
        }

        return $this;
    }

    public function removeItemRequest(ItemRequest $itemRequest): self
    {
        if ($this->itemRequests->contains($itemRequest)) {
            $this->itemRequests->removeElement($itemRequest);
            // set the owning side to null (unless already changed)
            if ($itemRequest->getUser() === $this) {
                $itemRequest->setUser(null);
            }
        }

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
            $rental->setTenant($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->contains($rental)) {
            $this->rentals->removeElement($rental);
            // set the owning side to null (unless already changed)
            if ($rental->getTenant() === $this) {
                $rental->setTenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rental[]
     */
    public function getRenterRentals(): Collection
    {
        return $this->renterRentals;
    }

    public function addRenterRental(Rental $renterRental): self
    {
        if (!$this->renterRentals->contains($renterRental)) {
            $this->renterRentals[] = $renterRental;
            $renterRental->setRenter($this);
        }

        return $this;
    }

    public function removeRenterRental(Rental $renterRental): self
    {
        if ($this->renterRentals->contains($renterRental)) {
            $this->renterRentals->removeElement($renterRental);
            // set the owning side to null (unless already changed)
            if ($renterRental->getRenter() === $this) {
                $renterRental->setRenter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatingsAsEditor(): Collection
    {
        return $this->ratingsAsEditor;
    }

    public function addRatingsAsEditor(Rating $ratingsAsEditor): self
    {
        if (!$this->ratingsAsEditor->contains($ratingsAsEditor)) {
            $this->ratingsAsEditor[] = $ratingsAsEditor;
            $ratingsAsEditor->setEditor($this);
        }

        return $this;
    }

    public function removeRatingsAsEditor(Rating $ratingsAsEditor): self
    {
        if ($this->ratingsAsEditor->contains($ratingsAsEditor)) {
            $this->ratingsAsEditor->removeElement($ratingsAsEditor);
            // set the owning side to null (unless already changed)
            if ($ratingsAsEditor->getEditor() === $this) {
                $ratingsAsEditor->setEditor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatingsAsRenter(): Collection
    {
        return $this->ratingsAsRenter;
    }

    public function addRatingsAsRenter(Rating $ratingsAsRenter): self
    {
        if (!$this->ratingsAsRenter->contains($ratingsAsRenter)) {
            $this->ratingsAsRenter[] = $ratingsAsRenter;
            $ratingsAsRenter->setRenter($this);
        }

        return $this;
    }

    public function removeRatingsAsRenter(Rating $ratingsAsRenter): self
    {
        if ($this->ratingsAsRenter->contains($ratingsAsRenter)) {
            $this->ratingsAsRenter->removeElement($ratingsAsRenter);
            // set the owning side to null (unless already changed)
            if ($ratingsAsRenter->getRenter() === $this) {
                $ratingsAsRenter->setRenter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatingsAsTenant(): Collection
    {
        return $this->ratingsAsTenant;
    }

    public function addRatingsAsTenant(Rating $ratingsAsTenant): self
    {
        if (!$this->ratingsAsTenant->contains($ratingsAsTenant)) {
            $this->ratingsAsTenant[] = $ratingsAsTenant;
            $ratingsAsTenant->setTenant($this);
        }

        return $this;
    }

    public function removeRatingsAsTenant(Rating $ratingsAsTenant): self
    {
        if ($this->ratingsAsTenant->contains($ratingsAsTenant)) {
            $this->ratingsAsTenant->removeElement($ratingsAsTenant);
            // set the owning side to null (unless already changed)
            if ($ratingsAsTenant->getTenant() === $this) {
                $ratingsAsTenant->setTenant(null);
            }
        }

        return $this;
    }
}
