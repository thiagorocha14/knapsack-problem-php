<?php

use App\Http\Controllers\SolveKnapsackController;
use Illuminate\Support\Facades\Route;

Route::post('/solve', SolveKnapsackController::class);
