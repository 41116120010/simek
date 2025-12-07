<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Services\TripayCallback;

Route::post('tripay/callback', [TripayCallback::class, 'handle']);