<?php

namespace App\Portmone\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="integer");
     */
    private $userId;

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserId(): UserEntity
    {
        return $this->userId;
    }

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $parentId;

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @Assert\NotBlank(message="The folder name is required")
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nameFolder;

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
     * @ORM\OneToMany(targetEntity="App\Portmone\Entity\CardEntity", mappedBy="folderId")
     */
    private $cards;

    public function __construct()
    {
//        $tmp = Validator::notBlank($this->cards);
        $this->cards = new ArrayCollection();
    }
    /**
     * @return Collection|CardEntity[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

}
