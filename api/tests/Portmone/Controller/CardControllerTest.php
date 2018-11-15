<?php

namespace App\Portmone\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\CardEntity;

class CardControllerTest extends WebTestCase
{

    public function testCreateCardTest()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/card',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'folderId' => 1,
                'number' => 222222,
                'cash' => 123
            ])
        );
        var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 201);

    }

    public function testUpdateCardTest()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/card',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'id'=>9,
                'cash' => 0.50
            ])
        );
        var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 200);

    }

    public function testDeleteCardTest()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/card',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode(['id'=>16])
        );
        var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 200);
    }


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
