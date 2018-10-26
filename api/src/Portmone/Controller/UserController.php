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
use Gesdinet\JWTRefreshTokenBundle\Entity\AbstractRefreshToken;


class UserController extends Controller
{

/**
*@Route("/user", methods={"POST"})
*/
 public function createAction(Request $request) : Response
  {

    try {
        $data = json_decode($request->getContent(), true);
        var_dump($data);
        $entityManager = $this->getDoctrine()->getManager();
        $user = new UserEntity();
        $user->setPassword($data['password']);
        $user->setEmail($data['email']);
        $entityManager->persist($user);
        $entityManager->flush();

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
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->find(UserEntity::class, $data['id']);
        if (!$user) {
            throw $this->createNotFoundException(
               'No user found for id '.$data['id']
            );
        }
        $user->setPassword($data['password']);
        $user->setPassword($data['email']);
        $entityManager->flush();

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
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->find(UserEntity::class, $data['id']);
            if (!$user) {
                throw $this->createNotFoundException(
                    'No user found for id '.[$data['id']]
                );
            }
            $entityManager->remove($user);
            $entityManager->flush();

            return new JsonResponse(['User deleted is successfully' => $data['id']], 201);
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
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->find(UserEntity::class, $data['email']);

            if (!$user) {
                throw $this->createNotFoundException(
                    'User not found' . [$data['email']]
                );
            }
            if(!$entityManager->find(UserEntity::class, $data['password'])) {
                throw $this->createNotFoundException(
                    'Invalid password for ' . [$data['email']]
                );
            }

            if($timeStump > time())
            {
                $this->refresh();
            }

            $token = $this->accessToken($data);

            return new JsonResponse(['token' => $token], 201);

        }catch (Exception $e) {
            return $this->fail($e);
        }
   }

   public function refreshToken()
   {
        //
   }
   public function accessToken($data)
   {

       $header = json_encode(["alg" => "HS256", "typ" => "JWT"]);
       $payload= json_encode([
           "userId"=> $data['id'],
           "iat"=>time(),
           'expires_in'=>time()+(60 * 60)]);

       $SECRET_KEY = 'EnterSandmanMetallica';
       $unsignedToken = base64_encode($header). '.' .base64_encode($payload);
       $signature = hash_hmac('sha256', $unsignedToken,$SECRET_KEY);




       var_dump( $token = base64_encode($header).
           '.' .base64_encode($payload).
           '.' .base64_encode($signature)
       );
   }
   private function fail(\Exception $e)
   {
       return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
   }

}

