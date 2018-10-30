<?php

namespace App\Portmone\Entity;
use App\Portmone\Exception\InvalidCardException;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileEntityRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $nameCard;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $cashMoney;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->nameCard;
    }

    public function setName(string $nameCard): self
    {
        $nameSize = strlen($nameCard);
        if($nameSize < 5 || $nameSize > 10){
            throw new InvalidCardException();
        }
        $this->nameCard = $nameCard;
        return $this;
    }

    public function getCash(): ?int
    {
        return $this->cashMoney;
    }

    public function setCash($cashMoney): self
    {
        $this->cashMoney = $cashMoney;
        return $this;
    }

}
