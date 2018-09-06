<?php

namespace App\Portmone\Controller; #простір імен , в якому лежать контролери

use Symfony\Component\HttpFoundation\Response;#виклик методу Респонс з дефолтної ліби
use Symfony\Component\Routing\Annotation\Route;

class UserAuthController #контролер
{
    /**
     * @Route("/auth")
    */
  public function userAuth() : Response #метод контролера для автентифікація
  {
    try {
      return new Response('Hello');
    } catch (Exception $e) {

    }
  }
}
