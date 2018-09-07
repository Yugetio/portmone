<?php

namespace App\Portmone\Controller; #простір імен , в якому лежать контролери

use Symfony\Component\HttpFoundation\Response;#виклик методу Респонс з дефолтної ліби
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAuthController extends Controller
{

  public function userAuth() : Response #метод контролера для автентифікація
  {
    try {
      return new Response('Hello');
    } catch (Exception $e) {

    }
  }
}
