<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;

Route::apiResource('subscribers', SubscriberController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
