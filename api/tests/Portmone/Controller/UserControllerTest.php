<?php

namespace App\Portmone\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\UserEntity;

class CreateUserControllerTest extends WebTestCase
{
//    public function testCreateUserControllerTest()
//    {
//        $client = static::createClient();
//        $client->request(
//            'POST',
//            '/user',
//            array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            json_encode(["password"=>"dimon123","email"=>"dimon@gmail12.com"])
//        );
//        var_dump($client->getResponse());
//        $this->assertJsonResponse($client->getResponse(), 201);
//    }

//     public function testUpdateActionTest()
//     {
//         $client = static::createClient();
//         $client->request(
//         'PUT',
//         '/user/6',
//         array(),
//         array(),
//         array('CONTENT_TYPE' => 'application/json'),
//         json_encode(["password"=>"update12345","email"=>"update@gmail.com"])
//    );
//     var_dump($client->getResponse());
//     $this->assertJsonResponse($client->getResponse(), 200);
//     }

//     public function testDeleteActionTest()
//     {
//         $client = static::createClient();
//         $client->request(
//         'DELETE',
//         '/user/6',
//         array(),
//         array(),
//         array('CONTENT_TYPE' => 'application/json')
//    );
//     var_dump($client->getResponse());
//     $this->assertJsonResponse($client->getResponse(), 200);
//     }

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
//        json_encode(["id"=>1])
//        );
//       var_dump($this->client->getResponse());
//       $this->assertJsonResponse($this->client->getResponse(), 200);
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
