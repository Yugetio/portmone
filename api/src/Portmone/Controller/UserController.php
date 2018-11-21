<?php

namespace App\Portmone\Controller;

use FOS\RestBundle\Tests\Fixtures\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Portmone\Entity\UserEntity;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UserController extends Controller
{

    public function validateUserCredentials(UserEntity $user, ValidatorInterface $validator)
    {
        $emailError = $validator->validateProperty($user, 'email');
        $passwordError = $validator->validateProperty($user, 'password');
        $errors = [];
        if(count($emailError) > 0) {
            $errors['emailError'] = $emailError[0]->getMessage();
        }
        if(count($passwordError) > 0) {
            $errors['passwordError'] = $passwordError[0]->getMessage();
        }
        return $errors;
    }


    /**
     * @Route("/user", methods="POST")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return Response
     */
 public function createUser(Request $request, ValidatorInterface $validator) : Response
  {
      try {
          $entityManager = $this->getDoctrine()->getManager();
          $user = new UserEntity();
          $user->setPassword($request->get('password') ?? '');
          $user->setEmail($request->get('email') ?? '');
          $user->updatedTimestamps();

          if($errors = $this->validateUserCredentials($user, $validator)) {
              return new JsonResponse($errors, 400);
          }
          $entityManager->persist($user);
          $entityManager->flush();
          return new JsonResponse(['msg' => 'User has been created successfully'], 201);
      } catch (\Exception $e) {
          return new JsonResponse($e);
      }
  }

    /**
     * @Route("/user/{id}", methods="PUT")
     * @param Request $request
     * @param int $id
     * @param ValidatorInterface $validator
     * @return Response
     */
 public function updateUser(Request $request, int $id, ValidatorInterface $validator) : Response
  {
      try {
          $entityManager = $this->getDoctrine()->getManager();
          $user = $entityManager->find(UserEntity::class, $id);
          if (!$user) {
              throw $this->createNotFoundException(
                  'No user found for id '.$id
              );
          }
          $user->setPassword($request->get('password') ?? '');
          $user->setEmail($request->get('email') ?? '');
          $user->updatedTimestamps();

          if($errors = $this->validateUserCredentials($user, $validator)) {
              return new JsonResponse($errors, 400);
          }

          $entityManager->flush();
          return new JsonResponse(['msg' => 'User has been updated successfully'], 200);
      } catch (Exception $e) {
          return $this->fail($e);
      }
  }


    /**
     * @Route("/user/{id}", methods="DELETE")
     * @param int $id
     * @return Response
     */
 public function deleteUser(int $id) : Response
 {
     try {
         $entityManager = $this->getDoctrine()->getManager();
         $user = $entityManager->find(UserEntity::class, $id);
         if (!$user) {
             throw $this->createNotFoundException(
                 'No user found for id '.$id
             );
         }
         $entityManager->remove($user);
         $entityManager->flush();
         return new JsonResponse(['msg' => 'User has been deleted successfully'], 200);
     } catch (Exception $e) {
         return $this->fail($e);
     }
 }


//    /**
//     * @Route("/auth", methods="POST")
//     * @param Request $request
//     * @return Response
//     */
//  public function userAuth(Request $request) : Response
//   {
//
//        try{
//            $repository = $this->getDoctrine()->getManager()->getRepository(UserEntity::class);
//            $myUser = $repository->findOneBy(['password' => $request->get('password')]);
//            return new JsonResponse($myUser);
////            if ( $myUser !== $request->get('email') || $myUser !== $request->get('password')) {
////                throw $this->createNotFoundException('User not found');
////            }
////            $token = $this->accessToken($myUser->id);
////            return new JsonResponse(['token' => $token], 200);
//        } catch (Exception $e) {
//            return $this->fail($e);
//        }
//   }

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

