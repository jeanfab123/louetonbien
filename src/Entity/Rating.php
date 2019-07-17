<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntitySlugTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Rating
{

    use EntitySlugTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rental", inversedBy="ratings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rental;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ratingsAsEditor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ratingsAsRenter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renter;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ratingsAsTenant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $globalRating;

    /**
     * @ORM\Column(type="integer")
     */
    private $punctualityRating;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemQualityConditionRating;

    /**
     * @ORM\Column(type="integer")
     */
    private $kindnessRating;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->generateSlug(
            $this->editor->getUsername()
                . $this->renter->getUsername()
                . $this->tenant->getUsername()
        );
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRental(): ?Rental
    {
        return $this->rental;
    }

    public function setRental(?Rental $rental): self
    {
        $this->rental = $rental;

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): self
    {
        $this->editor = $editor;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getGlobalRating(): ?int
    {
        return $this->globalRating;
    }

    public function setGlobalRating(int $globalRating): self
    {
        $this->globalRating = $globalRating;

        return $this;
    }

    public function getPunctualityRating(): ?int
    {
        return $this->punctualityRating;
    }

    public function setPunctualityRating(int $punctualityRating): self
    {
        $this->punctualityRating = $punctualityRating;

        return $this;
    }

    public function getItemQualityConditionRating(): ?int
    {
        return $this->itemQualityConditionRating;
    }

    public function setItemQualityConditionRating(int $itemQualityConditionRating): self
    {
        $this->itemQualityConditionRating = $itemQualityConditionRating;

        return $this;
    }

    public function getKindnessRating(): ?int
    {
        return $this->kindnessRating;
    }

    public function setKindnessRating(int $kindnessRating): self
    {
        $this->kindnessRating = $kindnessRating;

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
}
