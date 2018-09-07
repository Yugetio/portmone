<?php

namespace App\Portmone\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserAuthController extends Controller
{

/**
*@Route("/auth")
*/
  public function userAuth() : Response
  {
    try {
      throw new Exception("Error Processing Request", 1);

    } catch (Exception $e) {
        $httpStatusCode = array('Server Auth Error' => 500);
        return new Response(json_encode($httpStatusCode));
    }
  }
}
