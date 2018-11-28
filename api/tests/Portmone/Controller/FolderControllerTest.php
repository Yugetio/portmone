<?php

namespace App\Portmone\Controller;

use App\Portmone\RandomGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FolderControllerTest extends WebTestCase
{

    public function testCreateFolderWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'userId' => RandomGenerator::generateRandomNumber(5),
                'parentId' => RandomGenerator::generateRandomNumber(5),
                'nameFolder' => RandomGenerator::generateRandomName(10)
            ])
        );
        var_dump(RandomGenerator::generateRandomNumber(5));
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 201);
    }

    public function testCreateFolderWithTrueIdWrongName()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'userId' => RandomGenerator::generateRandomNumber(7),
                'parentId' => RandomGenerator::generateRandomNumber(7),
                'nameFolder' => ''
            ])
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateFolderWithoutIdTrueName()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'nameFolder' => RandomGenerator::generateRandomName(10)
            ])
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateFolderWithoutData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testUpdateFolderWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/folder/3',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'nameFolder' => RandomGenerator::generateRandomName(10)
            ])
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 200);
    }

    public function testUpdateFolderWithEmptyName()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/folder/3',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'nameFolder' => ""
            ])
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testUpdateFolderWithoutName()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/folder/3',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')
        );
        $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testUpdateFolderWithWrongIdInRoute()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/folder/9999',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')
        );
        $this->assertJsonResponse($client->getResponse(), 404);
    }


    public function testDeleteFolderWithTrueId()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/folder/15', //Change id !!!!!
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')
        );
        $this->assertJsonResponse($client->getResponse(), 200);
    }

    public function testDeleteFolderWithWrongIdInRoute()
    {
        $client = static::createClient();
        $client->request(
            'DELETE',
            '/folder/9999',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json')
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
