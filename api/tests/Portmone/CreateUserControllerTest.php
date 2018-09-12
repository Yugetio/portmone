<?php

namespace App\Portmone\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateUserControllerTest extends WebTestCase
{
    
    public function createUserControllerTest()
    {
        $client = static::createClient();
        $client->request('GET', '/auth');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
