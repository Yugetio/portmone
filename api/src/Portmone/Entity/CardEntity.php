<?php

namespace App\Portmone\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

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


    /**
     * @ORM\Column(type="integer");
     */
    private $folderId;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $cardNumber;


    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @ORM\Column(type="float", length=255)
     */
    private $cash;


    /**
     * @ORM\OneToMany(targetEntity="App\Portmone\Entity\TransactionEntity", mappedBy="cardID")
     */
    private $transactions;


    public function getFolderId()
    {
        return $this->folderId;
    }

    public function setFolderId(int $folderId)
    {
        $this->folderId = $folderId;
        return $this;
    }

    public function getNumber()
    {
        return $this->cardNumber;
    }


    public function getCash()
    {
        return $this->cash;
    }

    public function setCash(float $cash)
    {
        $this->cash = $cash;
        return $this;
    }


    /**
     * @return Collection|TransactionEntity[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }


    public function __construct(int $folderId, string $cardNumber, float $cash)
    {
        $this->folderId = $folderId;
        $this->cardNumber = $cardNumber;
        $this->cash = $cash;

        $this->transactions = new ArrayCollection();
    }

    public function serialize()
    {
        $serializedArray = [
            'folderId' => $this->folderId,
            'cardNumber' => $this->cardNumber,
            'cash' => $this->cash,
        ];
        return $serializedArray;
    }

    static function deserialize(array $data)
    {
        $validator = Validation::createValidator();
        $errors = [];
        if (!isset($data['folderId'])) {
            throw new BadRequestHttpException('Folder id shouldn`t be empty.');
        }
        if (!isset($data['cardNumber'])) {
            throw new BadRequestHttpException('Folder id shouldn`t be empty.');
        }
        if (!isset($data['cash'])) {
            throw new BadRequestHttpException('Cash shouldn`t be empty.');
        }
        $folderIdError = $validator->validate($data['folderId'], [
            new Assert\NotNull([
                'message' => 'The value shouldn`t be null.'
            ]),
            new Assert\Type([
                'type' => 'integer',
                'message' => 'The value {{ value }} is not a valid {{ type }}.'
            ]),
            new Assert\GreaterThanOrEqual([
                'value' => 0,
                'message' => 'The value must be greater or equal 0.'
            ])
        ]);

        $cardNumberError = $validator->validate($data['cardNumber'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'string',
                'message' => 'The value {{ value }} is not a valid {{ type }}.'
            ]),
            new Assert\Length([
                'min' => 16,
                'max' => 16,
                'exactMessage' => 'The value {{ value }} must be 16 characters long!'
            ])
        ]);

        $cashError = $validator->validate($data['cash'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'float',
                'message' => 'The value {{ value }} is not a valid {{ type }}.',
            ]),
            new Assert\GreaterThanOrEqual([
                'value' => 0,
                'message' => 'The value must be greater or equal 0.'
            ])
        ]);

        if(count($folderIdError) > 0) {
            $errors['folderIdError'] = $folderIdError[0]->getMessage();
        }
        if(count($cardNumberError) > 0) {
            $errors['cardNumberError'] = $cardNumberError[0]->getMessage();
        }
        if(count($cashError) > 0) {
            $errors['cashError'] = $cashError[0]->getMessage();
        }
        if($errors) {
            return $errors;
        }

        return new self(
            $data['folderId'],
            $data['cardNumber'],
            $data['cash']
        );
    }

}
