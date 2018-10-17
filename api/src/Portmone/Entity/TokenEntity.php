<?php
namespace App\Portmone\Entity;

use App\Portmone\Exception\InvalidSignUpException;

use Symfony\Component\Security\Core\User\UserInterface;

class TokenEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // добавьте ваши собственные поля
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}