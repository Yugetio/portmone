<?php

namespace App\Portmone\Controller;

use App\Portmone\Service\UserExist;
use App\Portmone\Service\DataBaseUserLoad;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Portmone\Exception\UserNotExistException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserAuthController extends Controller
{

/**
*@Route("/auth", methods={"POST"})
*/
  public function userAuth() : Response
  {
    $userExist = new UserExist();

    try {
        if ($userExist->existCheck()==false) {
            throw new UserNotExistException("Error Processing Request", 1);
        }else {
            $dataBaseUserLoad = new DataBaseUserLoad();
            $dataBaseUserLoad->userLoadFromDb();
        }

    }catch (UserNotExistException $e) {
        $httpStatusCode = array('Not Found User' => 404);
        return new Response(json_encode($httpStatusCode));
    }catch (Exception $e) {
        $httpStatusCode = array('Server Auth Error' => 500);
        return new Response(json_encode($httpStatusCode));
    }
  }
}
