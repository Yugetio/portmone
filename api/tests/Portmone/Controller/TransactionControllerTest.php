<?php

namespace App\Portmone\Controller;

use App\Portmone\RandomGenerator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TransactionControllerTest extends WebTestCase
{

    public function testCreateTransactionWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'sourceCardId' => RandomGenerator::generateRandomNumber(6),
                'destinationCardId' => RandomGenerator::generateRandomNumber(6),
                'transferredMoney' => RandomGenerator::generateRandomFloat(0.01, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 201);
    }

    public function testCreateTransactionWithoutData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }


    public function testCreateTransactionWithoutSourceCardId()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'destinationCardId' => RandomGenerator::generateRandomNumber(6),
                'transferredMoney' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateTransactionWithoutDestinationCardId()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'sourceCardId' => RandomGenerator::generateRandomNumber(6),
                'transferredMoney' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateTransactionWithoutTransferredMoney()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'sourceCardId' => RandomGenerator::generateRandomNumber(6),
                'destinationCardId' => RandomGenerator::generateRandomNumber(6),
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateTransactionWithEmptyData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/transaction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'sourceCardId' => '',
                'destinationCardId' => '',
                'transferredMoney' => ''
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }


    public function testSearchTransactionGreatThanTransferredMoney()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/money_great_than',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'transferredMoney' => 1000
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 200);
    }


    protected function assertJsonResponse(Response $response, $statusCode = 200)
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
