<?php
/**
 * Created by PhpStorm.
 * User: okrylov
 * Date: 07.09.18
 * Time: 12:01
 */

namespace App\Portmone\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserControllerTest extends WebTestCase
{
    public function testSuccessCreate()
    {
        $client = static::createClient();
        $client->request('POST', '/user');
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
