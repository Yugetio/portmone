<?php

namespace App\Portmone\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class TransactionControllerTest extends WebTestCase
{
//    public function testCreateTransaction()
//    {
//        $client = static::createClient();
//        $client->request(
//            'POST',
//            '/transaction',
//            array(),
//            array(),
//            array('CONTENT_TYPE' => 'application/json'),
//            json_encode([
//                'sourceCardId' => "111111",
//                'destinationCardId' => "222222",
//                'money' => 1
//            ])
//        );
//        var_dump($client->getResponse());
//        $this->assertJsonResponse($client->getResponse(), 201);
//    }
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
