<?php

namespace App\Portmone\Controller;

use App\Portmone\RandomGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserControllerTest extends WebTestCase
{

   public function testCreateUserWithTrueData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => RandomGenerator::generateRandomNumber(7),
                "email" => RandomGenerator::generateRandomEmail(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 201);
    }

    public function testCreateUserWithPassWithoutEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => RandomGenerator::generateRandomNumber(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateUserWithoutPassWithEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "email" => RandomGenerator::generateRandomEmail(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateUserWithoutData()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );
        $this->assertJsonResponse($client->getResponse(), 500);
    }

    public function testCreateUserWithEmptyPasswordEmptyEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "",
                "email" => ""
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateUserWithTruePassEmptyEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "test123",
                "email" => ""
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateUserWithTruePassWrongEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "test123",
                "email" => "123"
            ])
        );
        //var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 400);
    }


    public function testCreateUserWithEmptyPassTrueEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "",
                "email" =>  RandomGenerator::generateRandomEmail(7)
            ])
        );
        //var_dump($client->getResponse());
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testCreateUserWithWrongPassTrueEmail()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/user',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => RandomGenerator::generateRandomNumber(3),
                "email" =>  RandomGenerator::generateRandomEmail(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

     public function testUpdateUserWithTrueData()
     {
         $client = static::createClient();
         $client->request(
             'PUT',
             '/user/1',
             [],
             [],
             ['CONTENT_TYPE' => 'application/json'],
             json_encode([
                 "password" => RandomGenerator::generateRandomNumber(10),
                 "email" => RandomGenerator::generateRandomEmail(7)
             ])
         );
         $this->assertJsonResponse($client->getResponse(), 200);
     }

    public function testUpdateUserWithEmptyData()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/user/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "",
                "email" => ""
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testUpdateUserWithTruePassWrongEmail()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/user/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => RandomGenerator::generateRandomNumber(10),
                "email" => "ss"
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testUpdateUserWithWrongPassTrueEmail()
    {
        $client = static::createClient();
        $client->request(
            'PUT',
            '/user/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => "1",
                "email" => RandomGenerator::generateRandomEmail(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 400);
    }

    public function testUpdateUserWithWrongId()
    {

        $client = static::createClient();
        $client->request(
            'PUT',
            '/user/99999',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                "password" => RandomGenerator::generateRandomNumber(10),
                "email" => RandomGenerator::generateRandomEmail(7)
            ])
        );
        $this->assertJsonResponse($client->getResponse(), 404);
    }

    public function testDeleteUserWithTrueId()
     {
         $client = static::createClient();
         $client->request(
         'DELETE',
         '/user/12',  //change id!!!!
             [],
             [],
             ['CONTENT_TYPE' => 'application/json']
         );
         $this->assertJsonResponse($client->getResponse(), 200);
     }

    public function testDeleteUserWithWrongId()
     {
         $client = static::createClient();
         $client->request(
             'DELETE',
             '/user/9999',
             [],
             [],
             ['CONTENT_TYPE' => 'application/json']
         );

         $this->assertEquals(
             404, $client->getResponse()->getStatusCode()
         );
         $this->assertContains('No user found for id', $client->getResponse()->getContent());
     }


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
//       //var_dump($this->client->getResponse());
//       $this->assertJsonResponse($this->client->getResponse(), 200);
//
//   }

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
