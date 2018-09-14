<?php

namespace App\Portmone\Controller;

use App\Portmone\Service\DataBase;
use App\Portmone\Service\UserDataValid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserController extends Controller
{

/**
*@Route("/user", methods={"POST"})
*/
  public function createAction() : Response
  {

    try {

        $entityManager = $this->getDoctrine()->getManager();
        $user = new UserEntity();
        $user->setPassword($response->get('password'));
        $user->setEmail($response->get('email'));
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['User create is successfully' => $user->getEmail()]);

    } catch (Exception $e) {
      return $this->fail($e);
    }
  }

  /**
  *@Route("/auth", methods={"POST"})
  */
  public function userAuth() : Response
  {

    try {
        $user = $this->getDoctrine()
        ->getRepository(UserEntity::class)
        ->find($email);

    if (!$user) {
        throw $this->createNotFoundException(
            'No user found for email '.$email
        );
    }

    return new Response('Hello: '->getName());

    }catch (Exception $e) {
          return $this->fail($e);
        }
  }

  private function fail(\Exception $e)
  {
      return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
  }
}
