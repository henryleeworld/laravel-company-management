<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'App\Http\Controllers\Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Abilities
    Route::apiResource('abilities', AbilitiesController::class, ['only' => ['index']]);

    // Locales
    Route::get('locales/languages', 'LocalesController@languages')->name('locales.languages');
    Route::get('locales/messages', 'LocalesController@messages')->name('locales.messages');

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
