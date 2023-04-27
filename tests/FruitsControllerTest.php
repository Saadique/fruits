<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FruitsControllerTest extends WebTestCase
{
    public function testGetAllfruitsReturnsJsonResponse(): void
    {
        $client = static::createClient();

        $client->request('GET', '/fruits');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetAllfruitsReturnsValidJson(): void
    {
        $client = static::createClient();

        $client->request('GET', '/fruits');

        $response = $client->getResponse();
        $content = $response->getContent();
        $data = json_decode($content, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('total', $data);
        $this->assertArrayHasKey('page', $data);
        $this->assertArrayHasKey('limit', $data);
    }

    public function testGetByIdReturnsJsonResponse(): void
    {
        $client = static::createClient();

        $client->request('GET', '/fruits/1');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }

    public function testGetByIdReturnsValidJson(): void
    {
        $client = static::createClient();

        $client->request('GET', '/fruits/60');

        $response = $client->getResponse();
        $content = $response->getContent();
        $data = json_decode($content, true);

        dd($data);
    }
}
