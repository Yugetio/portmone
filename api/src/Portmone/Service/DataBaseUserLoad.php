<?php

namespace App\Portmone\Service;

use App\Portmone\Entity\UserEntity;

/**
 *
 */
class DataBaseUserLoad
{

    function userLoadFromDb()
    {
        $data=json_decode( file_get_contents('php://input'), true );

        $user = $this->getDoctrine()
              ->getRepository(UserEntity::class)
              ->find($data['email']);

        return new Response('Login: '.$user->getEmail());
    }
}
