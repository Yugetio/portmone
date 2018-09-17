<?php

namespace App\Portmone\Entity;

use App\Portmone\Exception\InvalidSignUpException;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class UserEntity
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
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $passwordSize = strlen($password);
        if($passwordSize < 5 || $passwordSize > 32){
            throw new InvalidSignUpException();
        }

        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $emailSize = strlen($email);
        if($emailSize < 5 || $emailSize > 32){
            throw new InvalidSignUpException();
        }
        $this->email = $email;

        return $this;
    }
}
