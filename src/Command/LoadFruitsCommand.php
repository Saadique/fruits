<?php

namespace App\Command;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

class LoadFruitsCommand extends Command
{
    protected static $defaultName = 'app:load-fruits';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Import fruits from https://fruityvice.com/api/fruit/all to the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://fruityvice.com/api/fruit/all');
        $fruitsData = $response->toArray();

        foreach ($fruitsData as $fruitData) {
            $fruit = $this->entityManager->getRepository(Fruit::class)->findOneBy(['name' => $fruitData['name']]);

            if (!$fruit) {
                $fruit = new Fruit();
                $fruit->setName($fruitData['name']);
                $fruit->setSourceId($fruitData['id']);
                $fruit->setFamily($fruitData['family']);
                $fruit->setFruitOrder($fruitData['order']);
                $fruit->setGenus($fruitData['genus']);
                $fruit->setCalories($fruitData['nutritions']['calories']);
                $fruit->setFat($fruitData['nutritions']['fat']);
                $fruit->setSugar($fruitData['nutritions']['sugar']);
                $fruit->setCarbohydrates($fruitData['nutritions']['carbohydrates']);
                $fruit->setProtein($fruitData['nutritions']['protein']);
                $this->entityManager->persist($fruit);
            }
        }

        $this->entityManager->flush();

        $output->writeln('Fruits loaded successfully');

        return Command::SUCCESS;
    }
}
