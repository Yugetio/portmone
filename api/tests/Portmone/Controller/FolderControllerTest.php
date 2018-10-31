<?php

namespace App\Portmone\Controller;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Portmone\Entity\FolderEntity;

class FolderControllerTest extends WebTestCase
{

    public function createFolderTest()
    {
        $this->client = static::createClient();
        $this->client->request(
            'POST',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'nameFolder' => 'FolderUser'
            ])
        );
        $this->client->getResponse();
        $this->assertJsonResponse($this->client->getResponse(), 201, false);

    }

    public function updateFolderTest()
    {
        $this->client = static::createClient();
        $this->client->request(
            'PUT',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode([
                'id'=>1,
                'nameFolder' => 'FolderUser'
            ])
        );
        $this->client->getResponse();
        $this->assertJsonResponse($this->client->getResponse(), 201, false);

    }

    public function deleteFolderTest()
    {
        $this->client = static::createClient();
        $this->client->request(
            'DELETE',
            '/folder',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode(["id"=>1])
        );
        var_dump($this->client->getResponse());
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
