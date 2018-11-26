<?php

namespace App\Portmone\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderEntityRepository")
 */
class FolderEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Assert\NotBlank(message="The user Id  is required")
     * @ORM\Column(type="integer", length=255);
     */
    private $userId;


    /**
     * @Assert\NotBlank(message="The parent Id  is required")
     * @ORM\Column(type="integer", length=255)
     */
    private $parentId;

    /**
     * @Assert\NotBlank(message="The folder name is required")
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nameFolder;


    /**
     * @ORM\OneToMany(targetEntity="App\Portmone\Entity\CardEntity", mappedBy="folderId")
     */
    private $cards;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }


    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }


    public function getParentId()
    {
        return $this->parentId;
    }


    public function getName(): string
    {
        return $this->nameFolder;
    }

    public function setName(string $nameFolder): self
    {
        $this->nameFolder = $nameFolder;
        return $this;
    }


    /**
     * @return Collection|CardEntity[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }


    public function __construct(int $userId, int $parentId, string $nameFolder)
    {
        $this->userId = $userId;
        $this->parentId = $parentId;
        $this->nameFolder = $nameFolder;

        $this->cards = new ArrayCollection();
    }

     public function serialize()
     {
        $serializedArray = [
            'userId' => $this->userId,
            'parentId' => $this->parentId,
            'nameFolder' => $this->nameFolder,
        ];
        return $serializedArray;
     }

    static function deserialize(array $data)
    {
        $validator = Validation::createValidator();

        $userIdError = $validator->validate($data['userId'], [
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

        $parentIdError = $validator->validate($data['parentId'], [
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

        $nameFolderError = $validator->validate($data['nameFolder'], [
            new Assert\NotBlank(),
            new Assert\Type([
                'type'    => 'string',
                'message' => 'The value {{ value }} is not a valid {{ type }}.',
            ])
        ]);

        $errors = [];

        if(count($userIdError) > 0) {
            $errors['$userIdError'] = $userIdError[0]->getMessage();
        }
        if(count($parentIdError) > 0) {
            $errors['$parentIdError'] = $parentIdError[0]->getMessage();
        }
        if(count($nameFolderError) > 0) {
            $errors['$nameFolderError'] = $nameFolderError[0]->getMessage();
        }
        if($errors) {
            return $errors;
        }

        return new self(
            $data['userId'],
            $data['parentId'],
            $data['nameFolder']
        );
    }

}