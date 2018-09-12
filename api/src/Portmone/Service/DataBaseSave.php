<?php

namespace App\Portmone\Service;

use App\Portmone\Entity\UserEntity;

/**
 *
 */
class DataBaseSave
{

    function saveToDb()
    {
        $data=json_decode( file_get_contents('php://input'), true );
        $em = $this->getDoctrine()->getManager();

        $user = new UserEntity();
        $user->setPassword(strlen($data['name']));
        $user->setEmail(trlen($data['email']));

        $em->persist($user);
        $em->flush();

        return new Response('Saved new product with id '.$user->getId());
    }
}
