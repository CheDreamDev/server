<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiDocControllerTest.
 */
class ApiDocControllerTest extends WebTestCase
{
    /**
     * Test fot successful api doc endpoint
     */
    public function testApiDoc()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'apidoc',
            'PHP_AUTH_PW' => 'qwerty',
        ]);

        $client->request(Request::METHOD_GET, '/api');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertContains('udream', $client->getResponse()->getContent());
    }

    /**
     * Test fot wrong api doc endpoint
     */
    public function testWrongApiDoc()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/api');

        $this->assertSame(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }
}
