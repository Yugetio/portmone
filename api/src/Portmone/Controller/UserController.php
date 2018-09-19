<?php

namespace App\Portmone\Controller;

use App\Portmone\Service\DataBase;
use App\Portmone\Service\UserDataValid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

use App\Portmone\Entity\UserEntity;

class UserController extends Controller
{

/**
*@Route("/user", methods={"POST"})
*/
 public function createAction(Request $request) : Response
  {

    try {

        $data = json_decode($request->getContent(), true);
        $entityManager = $this->getDoctrine()->getManager();
        $user = new UserEntity();
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $entityManager->persist($user);
        $entityManager->flush();
        return new JsonResponse(['User created is successfully' => $user->getEmail()], 201);

    } catch (Exception $e) {
      return $this->fail($e);
    }
  }


/**
*@Route("/user", methods={"PUT"})
*/
 public function updateAction(Request $request) : Response
  {

    try {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(UserEntity::class)->find($data['id']);
        if (!$user) {
            throw $this->createNotFoundException(
               'No product found for id '.$data['id']
            );
        }

        $user->setPassword($data['password']);
        $user->setPassword($data['email']);
        $em->flush();
        return new JsonResponse(['User update is successfully' => $data['id']], 201);

        var_dump($data);

      } catch (Exception $e) {
        return $this->fail($e);
      }
  }


/**
*@Route("/user", methods={"DELETE"})
*/
 public function deleteAction(Request $request) : Response
 {

    try {
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(UserEntity::class)->find($data['email']);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for email '.$data['email']
            );
        }

        $em->remove($user);
        $em->flush();

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
