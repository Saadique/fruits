<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class FruitsController 
{

    #[Route('fruits', name: 'fruits', methods: 'GET')]
    public function getAllfruits()
    {
        dd("working");
    }
}