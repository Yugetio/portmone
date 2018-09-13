<?php

namespace App\Portmone\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateUserControllerTest extends WebTestCase
{

    public function createUserControllerTest()
    {
        $this->client = static::createClient();
        $this->client->request(
        'POST',
        '/user',
        array(),
        array(),
        array('CONTENT_TYPE' => 'application/json'),
        '[{"name":"vasya","email":"vasyapupkin@gmail.com"}]'
   );
   $this->assertJsonResponse($this->client->getResponse(), 201, false);
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
