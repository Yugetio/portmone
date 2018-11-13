<?php

namespace App\Portmone\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\CardEntity;

class CardControllerTest extends WebTestCase
{
//
//    public function createCardTest()
//    {
//        $this->client = static::createClient();
//        $this->client->request(
//            'POST',
//            '/card',
//            array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            json_encode([
//                'nameCard' => 'CardUser',
//                'cashMoney' => '123'
//            ])
//        );
//        $this->client->getResponse();
//        $this->assertJsonResponse($this->client->getResponse(), 201, false);
//
//    }
//
//    public function updateCardTest()
//    {
//        $this->client = static::createClient();
//        $this->client->request(
//            'PUT',
//            '/card',
//            array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            json_encode([
//                'id'=>1,
//                'nameCard' => 'CardUser',
//                'cashMoney' => 123
//            ])
//        );
//        $this->client->getResponse();
//        $this->assertJsonResponse($this->client->getResponse(), 201, false);
//
//    }
//
//    public function deleteCardTest()
//     {
//         $this->client = static::createClient();
//         $this->client->request(
//         'DELETE',
//         '/card',
//         array(),
//         array(),
//         array('CONTENT_TYPE' => 'application/json'),
//         json_encode(["id"=>1])
//    );
//     var_dump($this->client->getResponse());
//     $this->assertJsonResponse($this->client->getResponse(), 201, false);
//     }
//
//
//
//    protected function assertJsonResponse($response, $statusCode = 200)
//    {
//        $this->assertEquals(
//            $statusCode, $response->getStatusCode(),
//            $response->getContent()
//        );
//        $this->assertTrue(
//            $response->headers->contains('Content-Type', 'application/json'),
//            $response->headers
//        );
//    }

}
