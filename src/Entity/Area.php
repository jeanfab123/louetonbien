<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AreaRepository")
 * @UniqueEntity("title")
 * @ORM\HasLifecycleCallbacks()
 */
class Area
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\rubric", mappedBy="area")
     */
    private $rubric;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute", mappedBy="area")
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ItemRequest", mappedBy="area")
     */
    private $itemRequests;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    public function __construct()
    {
        $this->rubric = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->itemRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|rubric[]
     */
    public function getRubric(): Collection
    {
        return $this->rubric;
    }

    public function addRubric(rubric $rubric): self
    {
        if (!$this->rubric->contains($rubric)) {
            $this->rubric[] = $rubric;
            $rubric->addArea($this);
        }

        return $this;
    }

    public function removeRubric(Rubric $rubric): self
    {
        if ($this->rubrics->contains($rubric)) {
            $this->rubrics->removeElement($rubric);
            $rubric->removeArea($this);
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->addArea($this);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->removeArea($this);
        }

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
            $itemRequest->addArea($this);
        }

        return $this;
    }

    public function removeItemRequest(ItemRequest $itemRequest): self
    {
        if ($this->itemRequests->contains($itemRequest)) {
            $this->itemRequests->removeElement($itemRequest);
            $itemRequest->removeArea($this);
        }

        return $this;
    }
}
