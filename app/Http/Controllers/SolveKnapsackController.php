<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolveKnapsackRequest;
use App\Services\KnapsackService;

class SolveKnapsackController extends Controller
{
    public function __construct(
        private readonly KnapsackService $knapsackService
    ) {
    }

    public function __invoke(SolveKnapsackRequest $request)
    {
        try {
            $startTime = microtime(true);

            $products = $request->get('products');
            $knapsackCapacity = $request->get('knapsack_capacity');

            $solution = $this->knapsackService->solve($products, $knapsackCapacity);

            $endTime = microtime(true);

            $executionTime = $endTime - $startTime;

            return response()->json([
                'solution' => $solution->toArray(),
                'message' => 'Knapsack problem solved successfully',
                'execution_time' => $executionTime
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }
}
