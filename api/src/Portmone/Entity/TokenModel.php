<?php
namespace App\Portmone\Entity;


class TokenModel
{

    private $id;


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