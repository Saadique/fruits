<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ControllerBaseTestCase extends WebTestCase
{
    protected ContainerInterface $container;
    protected $client;
    protected function setUp(): void 
    {
        parent::setUp();
        $this->client = static:: createClient();
        $this->container = $this->client->getContainer(); 
    }
}