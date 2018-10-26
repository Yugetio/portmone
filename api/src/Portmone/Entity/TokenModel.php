<?php
namespace App\Portmone\Entity;

use App\Portmone\Exception\InvalidSignUpException;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Gesdinet\JWTRefreshTokenBundle\Entity\AbstractRefreshToken;


class TokenModel extends AbstractRefreshToken
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;
    private $refreshToken;
    private $time;
    private $accessToken;


    public function getId()
    {
        return $this->id;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
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