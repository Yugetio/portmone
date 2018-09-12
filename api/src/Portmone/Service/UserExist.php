<?php

namespace App\Portmone\Service;

use App\Portmone\Entity\UserEntity;

/**
 *
 */
class UserExist
{

    public function existCheck()
    {
        $user = $this->getDoctrine()
        ->getRepository(UserEntity::class)
        ->find($data['email']);

    if (!$user) {
            return false;
        };
    }
    
}
