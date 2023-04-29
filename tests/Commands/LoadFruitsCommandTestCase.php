<?php

namespace App\Tests\Commands;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\LoadFruitsCommand;

class LoadFruitsCommandTestCase extends KernelTestCase
{
    private $entityManager;
    private static $container;

    protected function setUp(): void
    {
        self::bootKernel();
        self::$container = self::$kernel->getContainer();
        $this->entityManager = self::$container->get(EntityManagerInterface::class);
    }

    public function testExecute()
    {
        $commandTester = new CommandTester(self::$container->get(LoadFruitsCommand::class));
        $commandTester->execute([]);
        $this->assertStringContainsString('Fruits loaded successfully', $commandTester->getDisplay());
        $fruits = $this->entityManager->getRepository(\App\Entity\Fruit::class)->findAll();
        // Number need to be updated if the API changes in the future
        $this->assertCount(40, $fruits); 
    }
}
