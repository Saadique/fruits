<?php

namespace App\Tests\Controllers;

use App\Tests\ControllerBaseTestCase;

class FruitsControllerTest extends ControllerBaseTestCase
{
    public function testGetAllfruitsReturnsJsonResponse(): void
    {
        $this->client->request('GET', '/fruits');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testGetAllfruitsReturnsValidJson(): void
    {

        $this->client->request('GET', '/fruits');

        $response = $this->client->getResponse();
        $content = $response->getContent();
        $data = json_decode($content, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('total', $data);
        $this->assertArrayHasKey('page', $data);
        $this->assertArrayHasKey('limit', $data);
    }

    public function testGetByIdReturnsJsonResponse(): void
    {

        $this->client->request('GET', '/fruits/60');

        $this->assertResponseIsSuccessful();
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testInvalidGetByIdReturnsError(): void
    {  
        $this->client->request('GET', '/fruits/apple');

        $response = $this->client->getResponse();
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testInvalidNotExistsGetByIdReturnsError(): void
    {  
        $this->client->request('GET', '/fruits/1000000000000');

        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetByIdWithNegativeId(): void
    {  
        $this->client->request('GET', '/fruits/-23');

        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetByIdWithNull(): void
    {  
        $this->client->request('GET', '/fruits/null');

        $response = $this->client->getResponse();
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testGetByIdWithXssInjection(): void
    {  
        $id = '<script>alert("Hacked!");</script>';
        $this->client->request('GET', '/fruits/'.$id);

        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }
}
