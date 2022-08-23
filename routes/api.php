<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PricingRuleController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

// Menu Items
Route::get('/menu-item', [MenuItemController::class, 'index']);
Route::post('/menu-item', [MenuItemController::class, 'store']);
Route::delete('/menu-item/{id}', [MenuItemController::class, 'destroy']);

// Pricing Rules
Route::get('/pricing-rule', [PricingRuleController::class, 'index']);
Route::post('/pricing-rule', [PricingRuleController::class, 'store']);
Route::delete('/pricing-rule/{id}', [PricingRuleController::class, 'destroy']);

// Checkout
Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/test-checkout', [CheckoutController::class, 'test_checkout']);