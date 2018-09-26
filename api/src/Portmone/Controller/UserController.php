<?php

namespace App\Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Portmone\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Portmone\Entity\UserEntity;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserController extends Controller
{

/**
*@Route("/user", methods={"POST"})
*/
 public function createAction(Request $request) : Response
  {

    try {

        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = new UserEntity();
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $user->setToken();
        $em->persist($user);
        $em->flush();
    
        return new JsonResponse(['User created is successfully' => $user->getEmail()], 201);
    }catch (Exception $e) {
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
        $user = $em->find(UserEntity::class, $data['id']);
        if (!$user) {
            throw $this->createNotFoundException(
               'No user found for id '.$data['id']
            );
        }
        $user->setPassword($data['password']);
        $user->setPassword($data['email']);
        $user->setToken();
        $em->flush();

            return new JsonResponse(['User update is successfully' => $data['id']], 201);
        }catch (Exception $e) {
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
            $user = $em->find(UserEntity::class, $data['id']);
            if (!$user) {
                throw $this->createNotFoundException(
                    'No user found for id '.[$data['id']]
                );
            }
            $em->remove($user);
            $em->flush();
        }catch (Exception $e) {
            return $this->fail($e);
        }
 }


 /**
 *@Route("/auth", methods={"POST"})
 */
  public function userAuth(Request $request) : Response
   {
        try{

            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $user = $em->find(UserEntity::class, $data['email']);
            if (!$user) {
                throw $this->createNotFoundException(
                    'User not found' . [$data['email']]
                );
            }
            if($data['password']!=$em->find(UserEntity::class, $data['password'])){
                throw $this->Exception(
                    'Invalid password ' . [$data['email']]
                );
            }
            return new JsonResponse([
                    'id' => $data['id'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'token' => $em->find(UserEntity::class, $data['password'])], 201);

        }catch (Exception $e) {
            return $this->fail($e);
        }
   }

   private function fail(\Exception $e)
   {
       return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
   }
}
