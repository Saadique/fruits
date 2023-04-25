<?php

namespace App\Message;

use App\Entity\Fruit;

class NewFruitMessage
{
    private Fruit $fruit;

    public function __construct(Fruit $name)
    {
        $this->fruit = $name;
    }

    public function getFruit(): Fruit
    {
        return $this->fruit;
    }
}
