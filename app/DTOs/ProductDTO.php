<?php

namespace App\DTOs;

class ProductDTO
{
    public int $quantity;
    public int $price;
    public int $weight;

    public function __construct(
        int $quantity,
        int $price,
        int $weight
    ) {
        $this->quantity = $quantity;
        $this->price = $price;
        $this->weight = $weight;
    }
}