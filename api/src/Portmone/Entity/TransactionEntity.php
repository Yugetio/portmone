<?php

namespace App\Portmone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;


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


    /**
     * @ORM\Column(type="integer")
     */
    private $sourceCardId;


    /**
     * @ORM\Column(type="integer")
     */
    private $destinationCardId;


    /**
     * @ORM\Column(type="float")
     */
    private $transferredMoney;


    /**
     * @ORM\Column(type="datetime")
     */
    private $transactionDate;



    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSourceCardId()
    {
        return $this->sourceCardId;
    }
    public function setSourceCardId(int $sourceCardId)
    {
        $this->sourceCardId = $sourceCardId;
        return $this;
    }


    public function getDestinationCardId()
    {
        return $this->sourceCardId;
    }
    public function setDestinationCardId(int $destinationCardId)
    {
        $this->destinationCardId = $destinationCardId;
        return $this;
    }


    public function getTransferredMoney(): ?float
    {
        return $this->transferredMoney;
    }

    public function setTransferredMoney(float $transferredMoney): self
    {
        $this->transferredMoney = $transferredMoney;
        return $this;
    }


    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function __construct(int $sourceCardId, int $destinationCardId, float $transferredMoney)
    {
        $id = substr(uniqid('', true), -6);

        $this->id = $id;
        $this->sourceCardId = $sourceCardId;
        $this->destinationCardId = $destinationCardId;
        $this->transferredMoney = $transferredMoney;
        $this->transactionDate = time();
    }

    public function serialize()
    {
        $serializedArray = [
            'id' => $this->id,
            'sourceCardId' => $this->sourceCardId,
            'destinationCardId' => $this->destinationCardId,
            'transferredMoney' => $this->transferredMoney,
            'date' => $this->transactionDate
        ];
        return $serializedArray;
    }

    /**
     * @param array $data
     * @return TransactionEntity|array
     */
    static function deserialize(array $data)
    {
        $validator = Validation::createValidator();
        $errors = [];
        if (!isset($data['sourceCardId'])) {
            throw new BadRequestHttpException('source card id shouldn`t be empty.');
        }
        if (!isset($data['destinationCardId'])) {
            throw new BadRequestHttpException('destination card id shouldn`t be empty.');
        }
        if (!isset($data['transferredMoney'])) {
            throw new BadRequestHttpException('Transferred money shouldn`t be empty.');
        }

        $sourceCardIdError = $validator->validate($data['sourceCardId'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'integer',
                'message' => 'The value {{ value }} is not a valid {{ type }}.'
            ]),
            new Assert\GreaterThanOrEqual([
                'value' => 0,
                'message' => 'The value must be greater or equal 0.'
            ])
        ]);

        $destinationCardIdError = $validator->validate($data['destinationCardId'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'integer',
                'message' => 'The value {{ value }} is not a valid {{ type }}.'
            ]),
            new Assert\GreaterThanOrEqual([
                'value' => 0,
                'message' => 'The value must be greater or equal 0.'
            ]),
        ]);

        $transferredMoneyError = $validator->validate($data['transferredMoney'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'float',
                'message' => 'The value {{ value }} is not a valid {{ type }}.',
            ])
        ]);

        if(count($sourceCardIdError) > 0) {
            $errors['$sourceCardIdError'] = $sourceCardIdError[0]->getMessage();
        }
        if(count($destinationCardIdError) > 0) {
            $errors['$destinationCardIdError'] = $destinationCardIdError[0]->getMessage();
        }
        if(count($transferredMoneyError) > 0) {
            $errors['$transferredMoneyError'] = $transferredMoneyError[0]->getMessage();
        }
        if($errors) {
            return $errors;
        }

        return new self(
            $data['sourceCardId'],
            $data['destinationCardId'],
            $data['transferredMoney']);
    }
}
