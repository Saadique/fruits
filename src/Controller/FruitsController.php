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
            $perPage = $request->query->getInt('limit', 12);

            $name = $request->query->get('name', '');
            $family = $request->query->get('family', '');
            

            $qb = $this->fruitRepository->createQueryBuilder('f');

            if (!empty($name)) {
                $qb->andWhere('f.name LIKE :name')->setParameter('name', "%$name%");
            }

            if (!empty($family)) {
                $qb->andWhere('f.family = :family')->setParameter('family', $family);
            }

        
            $countQb = clone $qb;
            $totalFruits = (int) $countQb->select('COUNT(f.id)')
                ->getQuery()
                ->getSingleScalarResult();

            $fruits = $qb->orderBy('f.name', 'ASC')
                ->setFirstResult(($page - 1) * $perPage)
                ->setMaxResults($perPage)
                ->getQuery()
                ->getResult();

            $data = [
                'data' => $fruits,
                'total' => $totalFruits,
                'page' => $page,
                'limit' => $perPage,
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

            if(!$fruit){
                return $this->json(
                    $this->createNotFoundException('Fruit with id: '.$id.' was not found.'),
                    status: 404,
                    headers: ['Content-Type' => 'application/json;charset=UTF-8']
                );
            }

            return $this->json(
                $fruit,
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );


        } catch (Exception $e) {
            return $this->json($e, 500);
        }
    }
}