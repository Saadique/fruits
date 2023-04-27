<?php

namespace App\Tests;

use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FruitRepositoryTest extends KernelTestCase
{
    /**
     * @var FruitRepository
     */
    private $repository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->repository = $entityManager->getRepository(Fruit::class);
    }

    public function testSave(): void
    {
        $fruit = new Fruit();
        $fruit->setName('Apple');
        $fruit->setSourceId(123);
        $fruit->setFamily('TestFamily');

        $this->repository->save($fruit, true);

        $this->assertNotNull($fruit->getId());
    }

    public function testRemove(): void
    {
        $fruit = new Fruit();
        $fruit->setName('Banana');
        $fruit->setSourceId(123);
        $fruit->setFamily('TestFamily');
        

        $this->repository->save($fruit, true);

        $id = $fruit->getId(); // get the ID of the newly created fruit

        $this->repository->remove($fruit, true);

        $this->assertNull($this->repository->find($id));
    }
}
