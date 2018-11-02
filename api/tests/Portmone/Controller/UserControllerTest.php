<?php
//
//namespace App\Portmone\Controller;
//
//use GuzzleHttp\Client;
//use PHPUnit\Framework\TestCase;
//use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use App\Portmone\Entity\UserEntity;
//
//class CreateUserControllerTest extends WebTestCase
//{
//     public function testCreateUserControllerTest()
//     {
//         $client = static::createClient();
////         $this->client = static::createClient();
//         $client->request(
//         'POST',
//         '/user',
//         array(),
//         array(),
//         array('Content-type' => 'application/json'),
//         '{"password":"stepan14213","email":"stepan@gmail.com"])}'
//    );
//         $response = $client->getResponse();
//         var_dump($response);
//         $this->assertEquals(201,$response->getStatusCode());
//     }
//   //  public function testUpdateActionTest()
//   //  {
//   //      $this->client = static::createClient();
//   //      $this->client->request(
//   //      'PUT',
//   //      '/user',
//   //      array(),
//   //      array(),
//   //      array('CONTENT_TYPE' => 'application/json'),
//   //      json_encode(["password"=>"update12345","email"=>"update@gmail.com","id"=>1])
//   // );
//   //  var_dump($this->client->getResponse());
//   //  $this->assertJsonResponse($this->client->getResponse(), 201, false);
//   //  }
//   //
//   //  public function testDeleteActionTest()
//   //  {
//   //      $this->client = static::createClient();
//   //      $this->client->request(
//   //      'DELETE',
//   //      '/user',
//   //      array(),
//   //      array(),
//   //      array('CONTENT_TYPE' => 'application/json'),
//   //      json_encode(["id"=>1])
//   // );
//   //  var_dump($this->client->getResponse());
//   //  $this->assertJsonResponse($this->client->getResponse(), 201, false);
//   //  }
//   //
////   public function testUserAuthTest()
////   {
////
////        $this->client = static::createClient();
////        $this->client->request(
////        'POST',
////        '/auth',
////        array(),
////        array(),
////        array('CONTENT_TYPE' => 'application/json'),
////        json_encode(["id"=>1])
////        );
////       var_dump($this->client->getResponse());
////       $this->assertJsonResponse($this->client->getResponse(), 201, false);
////
////   }
////    protected function assertJsonResponse($response, $statusCode = 200)
////    {
////        $this->assertEquals(
////            $statusCode, $response->getStatusCode(),
////            $response->getContent()
////        );
////        $this->assertTrue(
////            $response->headers->contains('Content-Type', 'application/json'),
////            $response->headers
////        );
////    }
//}
