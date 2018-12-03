<?php

namespace App\Portmone\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

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
     * @ORM\Column(type="integer", length=255);
     */
    private $userId;


    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $parentId;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
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


    public function getUserId()
    {
        return $this->userId;
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
        $errors = [];
        if (!isset($data['userId'])) {
            throw new BadRequestHttpException('User id shouldn`t be empty.');
        }
        if (!isset($data['parentId'])) {
            $data['parentId'] = 0;
        }
        if (!isset($data['nameFolder'])) {
            throw new BadRequestHttpException('name folder shouldn`t be empty.');
        }
        $userIdError = $validator->validate($data['userId'], [
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

        $parentIdError = $validator->validate($data['parentId'], [
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

        $nameFolderError = $validator->validate($data['nameFolder'], [
            new Assert\NotNull([
                'message' => 'The value shouldn`t be null.'
            ]),
            new Assert\NotBlank(),
            new Assert\Type([
                'type' => 'string',
                'message' => 'The value {{ value }} is not a valid {{ type }}.',
            ])
        ]);

        if(count($userIdError) > 0) {
            $errors['userIdError'] = $userIdError[0]->getMessage();
        }
        if(count($parentIdError) > 0) {
            $errors['parentIdError'] = $parentIdError[0]->getMessage();
        }
        if(count($nameFolderError) > 0) {
            $errors['nameFolderError'] = $nameFolderError[0]->getMessage();
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