<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\EntitySlugTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRequestAnswerRepository")
 * @UniqueEntity("duplicateCheckField")
 * @ORM\HasLifecycleCallbacks()
 */
class ItemRequestAnswer
{

    use EntitySlugTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ItemRequest", inversedBy="itemRequestAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $itemRequest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="itemRequestAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $enabledAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $duplicateCheckField;

    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
    public function initializeDatasBeforeCreation()
    {
        $this->createdAt = new \DateTime();
        $this->generateCode(
            $this->itemRequest->getName()
                . $this->item->getUser()->getUsername()
                . $this->itemRequest->getUser()->getUsername()
        );
        $this->enabled = false;
        $this->duplicateCheckField = $this->itemRequest->getId() . '|' . $this->item->getId();
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

    public function getItemRequest(): ?ItemRequest
    {
        return $this->itemRequest;
    }

    public function setItemRequest(?ItemRequest $itemRequest): self
    {
        $this->itemRequest = $itemRequest;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
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

    public function __toString()
    {
        return $this->code;
    }

    public function getDuplicateCheckField(): ?string
    {
        return $this->duplicateCheckField;
    }

    public function setDuplicateCheckField(string $duplicateCheckField): self
    {
        $this->duplicateCheckField = $duplicateCheckField;

        return $this;
    }
}
