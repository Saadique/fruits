<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function getAllfruits(Request $request) : Response
    {
        try {
            $page = $request->query->getInt('page', 1);
            $limit = $request->query->getInt('limit', 10);
            $offset = ($page - 1) * $limit;

            $fruits = $this->fruitRepository->findBy([], null, $limit, $offset);
            $totalFruits = $this->fruitRepository->count([]);

            $data = [
                'data' => $fruits,
                'total' => $totalFruits,
                'page' => $page,
                'limit' => $limit,
            ];

            return $this->json(
                $data,
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );
        } catch (Exception $e) {
            return $this->json($e, 500);
        }
    }

    #[Route('fruits/{id}', name: 'get-fruit', methods: 'GET')]
    public function getById(int $id)
    {
        try {
            $fruit = $this->fruitRepository->find($id);

            return $this->json(
                $fruit ? $fruit : $this->createNotFoundException('Fruit with id: '.$id.' was not found.'),
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );
        } catch (Exception $e) {
            return $this->json($e, 500);
        }
    }
}