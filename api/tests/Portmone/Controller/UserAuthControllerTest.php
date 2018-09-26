<?php
/**
 * Created by PhpStorm.
 * User: okrylov
 * Date: 07.09.18
 * Time: 12:29
 */

namespace App\Portmone\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAuthControllerTest extends WebTestCase
{

    public function testGetAuth()
    {
        $client = static::createClient();
        $client->request('GET', '/auth');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
