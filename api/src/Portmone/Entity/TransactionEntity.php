<?php

namespace App\Portmone\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * @ORM\Entity
 */
class TransactionEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @ORM\Column(type="integer")
     */
    private $sourceCardId;

    public function getSourceCardId()
    {
        return $this->sourceCardId;
    }
    public function setSourceCardId(int $sourceCardId)
    {
        $this->sourceCardId = $sourceCardId;
        return $this;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $destinationCardId;

    public function getDestinationCardId()
    {
        return $this->sourceCardId;
    }
    public function setDestinationCardId(int $destinationCardId)
    {
        $this->destinationCardId = $destinationCardId;
        return $this;
    }

    /**
     * @ORM\Column(type="float")
     */
    private $transferredMoney;

    public function getTransferredMoney(): ?float
    {
        return $this->transferredMoney;
    }

    public function setTransferredMoney(float $transferredMoney): self
    {
        $this->transferredMoney = $transferredMoney;
        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $transactionDate;

    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function serialize($id)
    {
        $serializedArray = [
            'id' => $id,
            'sourceCardId' => $this->sourceCardId,
            'destinationCardId' => $this->destinationCardId,
            'transferredMoney' => $this->transferredMoney,
            'date' => $this->transactionDate
        ];
        return $serializedArray;
    }

    static function deserialize(array $data)
    {
        $transactionEntity = new TransactionEntity();
        $transactionEntity->setSourceCardId($data['sourceCardId']);
        $transactionEntity->setDestinationCardId($data['destinationCardId']);
        $transactionEntity->setTransferredMoney($data['transferredMoney']);
        $transactionEntity->setTransactionDate($data['date']);

        return $transactionEntity;
    }


}
