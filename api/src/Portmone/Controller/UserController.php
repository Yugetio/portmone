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
     * @Route("/user", methods="POST")
     * @param Request $request
     * @return Response
     */
 public function createAction(Request $request) : Response
  {
      try {
          $entityManager = $this->getDoctrine()->getManager();
          $user = new UserEntity();
          $user->setPassword($request->get('password'));
          $user->setEmail($request->get('email'));
          $entityManager->persist($user);
          $entityManager->flush();
          return new JsonResponse('User has created successfully', 201);
      } catch (\Exception $e) {
          return new JsonResponse($e);
      }
  }

    /**
     * @Route("/user/{id}", methods="PUT")
     * @param Request $request
     * @param int $id
     * @return Response
     */
 public function updateAction(Request $request, int $id) : Response
  {
      try {
          $entityManager = $this->getDoctrine()->getManager();
          $myUser = $entityManager->find(UserEntity::class, $id);
          if (!$myUser) {
              throw $this->createNotFoundException('No user found for id');
          }
          $myUser->setPassword($request->get('password'));
          $myUser->setEmail($request->get('email'));
          $entityManager->flush();
          return new JsonResponse('User has updated successfully', 200);
      } catch (Exception $e) {
          return $this->fail($e);
      }
  }


    /**
     * @Route("/user/{id}", methods="DELETE")
     * @param int $id
     * @return Response
     */
 public function deleteAction(int $id) : Response
 {
     try {
         $entityManager = $this->getDoctrine()->getManager();
         $myUser = $entityManager->find(UserEntity::class, $id);
         if (!$myUser) {
             throw $this->createNotFoundException('No user found for id');
         }
         $entityManager->remove($myUser);
         $entityManager->flush();
         return new JsonResponse('User has deleted successfully', 200);
     } catch (Exception $e) {
         return $this->fail($e);
     }
 }


    /**
     * @Route("/auth", methods="POST")
     * @param Request $request
     * @return Response
     */
  public function userAuth(Request $request) : Response
   {

        try{
            $repository = $this->getDoctrine()->getManager()->getRepository(UserEntity::class);
            $myUser = $repository->findOneBy(['password' => $request->get('password')]);
            return new JsonResponse($myUser);
//            if ( $myUser !== $request->get('email') || $myUser !== $request->get('password')) {
//                throw $this->createNotFoundException('User not found');
//            }
//            $token = $this->accessToken($myUser->id);
//            return new JsonResponse(['token' => $token], 200);
        } catch (Exception $e) {
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

