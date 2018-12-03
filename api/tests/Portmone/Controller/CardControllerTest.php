<?php

namespace App\Portmone\Controller;

use App\Portmone\RandomGenerator;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\CardEntity;

class CardControllerTest extends WebTestCase
{

    public function testCreateCardWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => RandomGenerator::generateRandomNumber(3),
                'cardNumber' => RandomGenerator::generateRandomCardNumber(16),
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 201);
    }

    public function testCreateCardWithoutData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateCardWithoutFolderId()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'cardNumber' => RandomGenerator::generateRandomCardNumber(16),
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateCardWithoutCardNumber()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => RandomGenerator::generateRandomNumber(3),
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateCardWithoutCash()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => RandomGenerator::generateRandomNumber(3),
                'cardNumber' => RandomGenerator::generateRandomCardNumber(16),
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateCardWithEmptyData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => '',
                'cardNumber' => '',
                'cash' => ''
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateCardWithWrongFolderId()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => -122,
                'cardNumber' => RandomGenerator::generateRandomCardNumber(16),
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateCardWithWrongCardNumber()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => RandomGenerator::generateRandomNumber(3),
                'cardNumber' => RandomGenerator::generateRandomCardNumber(10),
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateCardWithWrongCash()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'folderId' => RandomGenerator::generateRandomNumber(3),
                'cardNumber' => RandomGenerator::generateRandomCardNumber(16),
                'cash' => -RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }


    public function testUpdateCardWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/card/3',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 200);

    }

    public function testUpdateCardWithWrongData()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/card/3',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'cash' => -RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);

    }

    public function testUpdateCardWithoutData()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/card/3',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $this->assertJsonResponse($client->getResponse(), 500);

    }

    public function testUpdateCardWithInvalidRoute()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/card/9999',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'cash' => RandomGenerator::generateRandomFloat(0.1, 1000, 2)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 404);

    }

    public function testDeleteCardWithTrueRoute()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/card/9', //Change id!!!!
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
//        var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 200);
    }

    public function testDeleteCardWithInvalidRoute()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/card/9999',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $this->assertJsonResponse($client->getResponse(), 404);
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
