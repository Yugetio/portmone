<?php

namespace App\Portmone\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAuthControllerTest extends WebTe      stCase
{
    
    public function userAuthTest()
    {
        $client = static::createClient();
        $client->request('POST', '/user');
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
