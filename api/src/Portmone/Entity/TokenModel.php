<?php
namespace App\Portmone\Entity;

use App\Portmone\Exception\InvalidSignUpException;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


class TokenModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    private $id;
    private $refreshToken;
    private $time;
    private $accessToken;


    public function getId()
    {
        return $this->id;
    }

//    public function setId($id)
//    {
//        $this->id = $id;
//        return $this;
//    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function setRefreshToken($refreshToken): self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time): self
    {
        $this->time = $time;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }
}