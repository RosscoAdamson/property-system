<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Properties

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties');
    Route::post('{propertyId}/agents/{agentId}', [PropertyController::class, 'updateAgent']);
    Route::delete('{propertyId}/agents/{agentId}', [PropertyController::class, 'removeAgent']);
    Route::post('{propertyId}/agents', [PropertyController::class, 'storeAgent']);
    Route::get('{propertyId}', [PropertyController::class, 'show']);
});

// Agents

Route::prefix('agents')->group(function () {
    Route::get('/', [AgentController::class, 'index'])->name('agents');
    Route::post('{agentId}', [AgentController::class, 'update']);
    Route::post('/', [AgentController::class, 'store']);
});
