<?php

namespace App\Portmone\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderEntityRepository")
 */
class TransactionEntity
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
     * @ORM\Column(type="integer")
     */
    private $folderId;

    public function getFolderId(): ?FolderEntity
    {
        return $this->folderId;
    }

    /**
     * @ORM\Column(type="float")
     */
    private $transferredMoney;

    public function getTransferredMoney(): ?float
    {
        return $this->transferredMoney;
    }

    public function setTransferredMoney($transferredMoney)
    {
        $this->transferredMoney = $transferredMoney;
        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $transactionDate;

    public function getTransactionDate(): ?\DateTime
    {
        return $this->transactionDate;
    }

    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }


}
