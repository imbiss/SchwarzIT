<?php
namespace App\Test\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetUserControllerTest extends WebTestCase
{
    public function testGetUser()
    {
        $client = static::createClient();
        $client->request('GET', '/users');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}