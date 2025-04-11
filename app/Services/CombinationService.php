<?php

namespace App\Services;

use App\DTOs\CombinationDTO;

class CombinationService
{
    public static function createCombination(int $combinationNumber, array $products): CombinationDTO
    {
        $bases = array_map(function ($product) {
            return $product->quantity;
        }, $products);

        $selectedProducts = self::selectProducts($combinationNumber, $bases);
        [$price, $weight] = self::calculatePriceAndWeight($products, $selectedProducts);

        return new CombinationDTO($price, $weight, $selectedProducts);
    }

    public static function selectProducts(int $combinationNumber, array $bases): array
    {
        $selected_products = [];
        $quotient = $combinationNumber;
        $bases = array_reverse($bases);
        foreach ($bases as $base) {
            $rest = $quotient % ($base + 1);
            $quotient = intval($quotient / ($base + 1));
            array_unshift($selected_products, $rest);
        }
        $bases = array_reverse($bases);

        return $selected_products;
    }

    public static function calculatePriceAndWeight(array $products, array $selectedProducts): array
    {
        $price = 0;
        $weight = 0;
        foreach ($selectedProducts as $index => $quantity) {
            $product = $products[$index];
            $price += $product->price * $quantity;
            $weight += $product->weight * $quantity;
        }

        return [$price, $weight];
    }
}

