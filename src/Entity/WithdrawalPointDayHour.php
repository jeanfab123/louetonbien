<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WithdrawalPointDayHourRepository")
 */
class WithdrawalPointDayHour
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $begin;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\withdrawalPoint", inversedBy="withdrawalPointDayHours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $withdrawalPoint;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getBegin(): ?string
    {
        return $this->begin;
    }

    public function setBegin(string $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(string $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getWithdrawalPoint(): ?withdrawalPoint
    {
        return $this->withdrawalPoint;
    }

    public function setWithdrawalPoint(?withdrawalPoint $withdrawalPoint): self
    {
        $this->withdrawalPoint = $withdrawalPoint;

        return $this;
    }
}