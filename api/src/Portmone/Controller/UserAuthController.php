<?php
namespace App\Portmone\Controller; #простір імен , в якому лежать контролери
use Symfony\Component\HttpFoundation\Response;#виклик методу Респонс з дефолтної ліби
class UserAuthController #контролер
{

  public function getAuth() : Response #метод контролера для автентифікація
  {
    try {
        return $this->formResponse(200, ['status'=>'ok']);
    } catch (\Exception $e) {
        return $this->formResponse(500, ['status'=>'Internal Server Error']);
    }
  }

    private function formResponse(int $code, array $data) : Response
    {
        return new Response(json_encode($data), $code);
    }
}
