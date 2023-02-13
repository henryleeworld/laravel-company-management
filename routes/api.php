<?php

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
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Abilities
    Route::apiResource('abilities', AbilitiesController::class, ['only' => ['index']]);

    // Permissions
    Route::resource('permissions', PermissionsApiController::class);

    // Roles
    Route::resource('roles', RolesApiController::class);

    // Users
    Route::resource('users', UsersApiController::class);

    // Cities
    Route::resource('cities', CitiesApiController::class);

    // Categories
    Route::resource('categories', CategoriesApiController::class);

    // Companies
    Route::post('companies/media', [CompaniesApiController::class, 'storeMedia'])->name('companies.storeMedia');
    Route::resource('companies', CompaniesApiController::class);
});
