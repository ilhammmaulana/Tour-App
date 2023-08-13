<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DestinationCategoryController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\API\PlacesController;
use App\Http\Controllers\API\ReviewDestinationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth.refresh');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware([
    'auth.api'
])->group(function () {
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('change-password', [AuthController::class, 'updatePassword']);
    });
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::post('profile', [AuthController::class, 'update']);
    });
    Route::group([
        "prefix" => "resources"
    ], function () {
        Route::get('province', [PlacesController::class, 'getProvinces']);
        Route::get('city', [PlacesController::class, 'getCities']);
    });
    Route::prefix('destinations')->group(function () {
        Route::get('slider-images', [DestinationController::class, 'getSliderImage']);
        Route::resource('review', ReviewDestinationController::class)->only('index', 'store', 'update');
        Route::get('province/{id}', [DestinationController::class, 'getDestinationByProvinceId']);
        Route::get('city/{id}', [DestinationController::class, 'getDestinationByCityId']);
        Route::get('category', [DestinationController::class, 'getDestinationCategories']);
        Route::get('category/{id}', [DestinationCategoryController::class, 'getDestinationsByCategoryId']);
        Route::get('save', [DestinationController::class, 'getRecordSaveDestination']);
        Route::post('save', [DestinationController::class, 'toogleDestination']);
    });
    Route::resource('destinations', DestinationController::class)->only(['index', 'show']);
});
