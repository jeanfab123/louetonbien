<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RubricRepository")
 * @UniqueEntity("name")
 * @UniqueEntity("slug")
 * @ORM\HasLifecycleCallbacks()
 */
class Rubric
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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="rubric")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Area", inversedBy="rubric")
     */
    private $area;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="rubric")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute", mappedBy="rubric")
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ItemRequest", mappedBy="rubric")
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
        $this->area = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function setDescription(?string $description): self
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
            $category->addRubric($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeRubric($this);
        }

        return $this;
    }

    /**
     * @return Collection|area[]
     */
    public function getArea(): Collection
    {
        return $this->area;
    }

    public function addArea(area $area): self
    {
        if (!$this->area->contains($area)) {
            $this->area[] = $area;
        }

        return $this;
    }

    public function removeArea(area $area): self
    {
        if ($this->area->contains($area)) {
            $this->area->removeElement($area);
        }

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
            $tag->addRubric($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeRubric($this);
        }

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
            $attribute->addRubric($this);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->removeRubric($this);
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
            $itemRequest->addRubric($this);
        }

        return $this;
    }

    public function removeItemRequest(ItemRequest $itemRequest): self
    {
        if ($this->itemRequests->contains($itemRequest)) {
            $this->itemRequests->removeElement($itemRequest);
            $itemRequest->removeRubric($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
