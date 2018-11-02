<?php

namespace App\Portmone\Entity;

use App\Portmone\Exception\InvalidSignUpException;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;




/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class UserEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
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

//    /**
//     * @ORM\Column(type="string", length=255, unique=true)
//     */
//    private $refreshToken;
//
//    public function getRefreshToken()
//    {
//        return $this->refreshToken;
//    }
//
//    public function setRefreshToken($refreshToken): self
//    {
//        $this->refreshToken = $refreshToken;
//        return $this;
//    }
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

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
          'ROLE_USER'
        ];
    }

}
