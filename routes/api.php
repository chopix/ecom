<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaymentWebhookController;

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

// Routes for handling payment webhooks
Route::post('/payment/razorpay-callback', [PaymentWebhookController::class, 'handleRazorpayCallback']);
Route::post('/payment/paddle-webhook', [PaymentWebhookController::class, 'handlePaddleWebhook']);