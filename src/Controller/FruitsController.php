<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FruitsController extends AbstractController
{

    private FruitRepository $fruitRepository;

    public function __construct(FruitRepository $fruitRepository)
    {
        $this->fruitRepository = $fruitRepository;
    }

    #[Route('fruits', name: 'get-all-fruits', methods: 'GET')]
    public function getAllfruits()
    {
        $fruits = $this->fruitRepository->findAll();
        return $fruits;
    }

    #[Route('fruits/{id}', name: 'get-all-fruits', methods: 'GET')]
    public function getById(int $id)
    {
        $fruit = $this->fruitRepository->find($id);
        
        if(!$fruit){
            $this->createNotFoundException('Fruit with id: '.$id.' was not found.');
        }

        return $fruit;
    }
}