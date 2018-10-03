<?php

namespace App\Portmone\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\UserEntity;

class CreateUserControllerTest extends WebTestCase
{

     public function testCreateUserControllerTest()
     {
         $this->client = static::createClient();
         $this->client->request(
         'POST',
         '/user',
         array(),
         array(),
         array('CONTENT_TYPE' => 'application/json'),
         json_encode([
             "password"=>"petya1945",
             "email"=>"petya1945@gmail.com"])
    );
         var_dump($this->client->getResponse());
         $this->assertJsonResponse($this->client->getResponse(), 201, false);
         }

   //  public function testUpdateActionTest()
   //  {
   //      $this->client = static::createClient();
   //      $this->client->request(
   //      'PUT',
   //      '/user',
   //      array(),
   //      array(),
   //      array('CONTENT_TYPE' => 'application/json'),
   //      json_encode(["password"=>"update12345","email"=>"update@gmail.com","id"=>1])
   // );
   //  var_dump($this->client->getResponse());
   //  $this->assertJsonResponse($this->client->getResponse(), 201, false);
   //  }
   //
   //  public function testDeleteActionTest()
   //  {
   //      $this->client = static::createClient();
   //      $this->client->request(
   //      'DELETE',
   //      '/user',
   //      array(),
   //      array(),
   //      array('CONTENT_TYPE' => 'application/json'),
   //      json_encode(["id"=>1])
   // );
   //  var_dump($this->client->getResponse());
   //  $this->assertJsonResponse($this->client->getResponse(), 201, false);
   //  }
   //
//   public function testUserAuthTest()
//   {
//
//        $this->client = static::createClient();
//        $this->client->request(
//        'POST',
//        '/auth',
//        array(),
//        array(),
//        array('CONTENT_TYPE' => 'application/json'),
//        json_encode([
//            'password' => 'petya1945',
//            'email'=> 'petya1945@gmail.com'])
//        );
//       var_dump($this->client->getResponse());
//       $this->assertJsonResponse($this->client->getResponse(), 201, false);
//
//   }

    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
}
