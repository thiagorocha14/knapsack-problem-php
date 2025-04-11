<?php

namespace App\DTOs;

class KnapsackDTO
{
    public int $capacity;
    public int $number_of_combinations;
    public CombinationDTO $combination;

    public function __construct(
        int $capacity,
        int $number_of_combinations,
        CombinationDTO $combination
    ) {
        $this->capacity = $capacity;
        $this->number_of_combinations = $number_of_combinations;
        $this->combination = $combination;
    }

    public function toArray(): array
    {
        return [
            'capacity' => $this->capacity,
            'number_of_combinations' => $this->number_of_combinations,
            'combination' => $this->combination,
        ];
    }
}