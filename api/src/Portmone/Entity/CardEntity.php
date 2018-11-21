<?php

namespace App\Portmone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\This;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardEntityRepository")
 */
class CardEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="integer");
     */
    private $folderId;

    public function getFolderId(): ?FolderEntity
    {
        return $this->folderId;
    }
    public function setFolderId(int $folderId)
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * @ORM\Column(type="integer", length=255, unique=true)
     */
    private $cardNumber;

    public function getNumber(): ?int
    {
        return $this->cardNumber;
    }

    public function setNumber(int $cardNumber): self
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $cash;

    public function getCash(): ?float
    {
        return $this->cash;
    }

    public function setCash(float $cash): self
    {
        $this->cash = $cash;
        return $this;
    }


    /**
     * @ORM\OneToMany(targetEntity="App\Portmone\Entity\TransactionEntity", mappedBy="cardID")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }
    /**
     * @return Collection|TransactionEntity[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

}
