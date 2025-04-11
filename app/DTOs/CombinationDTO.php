<?php

namespace App\DTOs;

class CombinationDTO
{
    public int $price;
    public int $weight;
    public array $products;

    public function __construct(
        int $price,
        int $weight,
        array $products
    ) {
        $this->price = $price;
        $this->weight = $weight;
        $this->products = $products;
    }
}