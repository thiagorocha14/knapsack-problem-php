<?php

namespace App\Services;

use App\DTOs\KnapsackDTO;
use App\DTOs\CombinationDTO;
use App\DTOs\ProductDTO;

class KnapsackService
{
    private KnapsackDTO $knapsack;

    public function __construct()
    {
        $this->knapsack = new KnapsackDTO(0, 0, new CombinationDTO(0, 0, []));
    }

    public function solve(array $products, int $knapsackCapacity): KnapsackDTO
    {
        $products = array_map(function ($product) {
            return new ProductDTO($product['quantity'], $product['price'], $product['weight']);
        }, $products);

        $this->knapsack->capacity = $knapsackCapacity;
        $this->knapsack->number_of_combinations = $this->__calculateNumberOfCombinations($products);

        $begin = 0;
        $end = $this->knapsack->number_of_combinations;

        for ($i = $begin; $i < $end; $i++) {
            $combination = CombinationService::createCombination($i, $products);

            if (!$this->__canStoreProduct($combination, $this->knapsack->capacity)) {
                continue;
            }

            if ($this->__isBetterCombination($combination)) {
                $this->knapsack->combination = $combination;
            }
        }

        return $this->knapsack;
    }

    private function __calculateNumberOfCombinations(array $products): int
    {
        $quantities = array_map(function ($product) {
            return $product->quantity + 1;
        }, $products);

        $size = array_reduce($quantities, function ($carry, $quantity) {
            return $carry * $quantity;
        }, 1);

        return $size;
    }

    private function __canStoreProduct(CombinationDTO $combination, int $capacity): bool
    {
        return $combination->weight <= $capacity;
    }

    private function __isBetterCombination(CombinationDTO $combination): bool
    {
        if ($combination->price > $this->knapsack->combination->price) {
            return true;
        }

        if ($combination->price === $this->knapsack->combination->price) {
            if ($combination->weight < $this->knapsack->combination->weight) {
                return true;
            }
        }

        return false;
    }
}
