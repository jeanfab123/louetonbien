<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\EntitySlugTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRequestRepository")
 * @UniqueEntity("name")
 * @UniqueEntity("code")
 * @UniqueEntity("slug")
 * @ORM\HasLifecycleCallbacks()
 */
class ItemRequest
{

    use EntitySlugTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="itemRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="itemRequests")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Rubric", inversedBy="itemRequests")
     */
    private $rubric;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Area", inversedBy="itemRequests")
     */
    private $area;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemRequestAnswer", mappedBy="itemRequest")
     */
    private $itemRequestAnswers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserFile", mappedBy="itemRequest")
     */
    private $itemRequestFiles;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        //$this->generateSlug($this->user->getUsername());
        $this->generateSlug($this->getName());
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
        $this->rubric = new ArrayCollection();
        $this->area = new ArrayCollection();
        $this->itemRequestAnswers = new ArrayCollection();
        $this->itemRequestFiles = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Rubric[]
     */
    public function getRubric(): Collection
    {
        return $this->rubric;
    }

    public function addRubric(Rubric $rubric): self
    {
        if (!$this->rubric->contains($rubric)) {
            $this->rubric[] = $rubric;
        }

        return $this;
    }

    public function removeRubric(Rubric $rubric): self
    {
        if ($this->rubric->contains($rubric)) {
            $this->rubric->removeElement($rubric);
        }

        return $this;
    }

    /**
     * @return Collection|Area[]
     */
    public function getArea(): Collection
    {
        return $this->area;
    }

    public function addArea(Area $area): self
    {
        if (!$this->area->contains($area)) {
            $this->area[] = $area;
        }

        return $this;
    }

    public function removeArea(Area $area): self
    {
        if ($this->area->contains($area)) {
            $this->area->removeElement($area);
        }

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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|ItemRequestAnswer[]
     */
    public function getItemRequestAnswers(): Collection
    {
        return $this->itemRequestAnswers;
    }

    public function addItemRequestAnswer(ItemRequestAnswer $itemRequestAnswer): self
    {
        if (!$this->itemRequestAnswers->contains($itemRequestAnswer)) {
            $this->itemRequestAnswers[] = $itemRequestAnswer;
            $itemRequestAnswer->setItemRequest($this);
        }

        return $this;
    }

    public function removeItemRequestAnswer(ItemRequestAnswer $itemRequestAnswer): self
    {
        if ($this->itemRequestAnswers->contains($itemRequestAnswer)) {
            $this->itemRequestAnswers->removeElement($itemRequestAnswer);
            // set the owning side to null (unless already changed)
            if ($itemRequestAnswer->getItemRequest() === $this) {
                $itemRequestAnswer->setItemRequest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserFile[]
     */
    public function getItemRequestFiles(): Collection
    {
        return $this->itemRequestFiles;
    }

    public function addItemRequestFile(UserFile $itemRequestFile): self
    {
        if (!$this->itemRequestFiles->contains($itemRequestFile)) {
            $this->itemRequestFiles[] = $itemRequestFile;
            $itemRequestFile->setItemRequest($this);
        }

        return $this;
    }

    public function removeItemRequestFile(UserFile $itemRequestFile): self
    {
        if ($this->itemRequestFiles->contains($itemRequestFile)) {
            $this->itemRequestFiles->removeElement($itemRequestFile);
            // set the owning side to null (unless already changed)
            if ($itemRequestFile->getItemRequest() === $this) {
                $itemRequestFile->setItemRequest(null);
            }
        }

        return $this;
    }
}
