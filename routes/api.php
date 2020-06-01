<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['projects' => 'API\ProjectController']);
Route::put('updatelogo/{id}', 'API\ProjectController@updateLogo');

Route::apiResources(['blog' => 'API\BlogController']);

Route::apiResources(['category' => 'API\CategoryController']);

Route::apiResources(['service' => 'API\ServicesController']);

Route::apiResources(['users' => 'API\UserController']);
Route::put('updatepersonalinfo/{id}', 'API\UserController@updatePersonalInfo');
Route::put('updateemail/{id}', 'API\UserController@updateEmail');
Route::put('updateimage/{id}', 'API\UserController@updateImage');
Route::put('updatepassword/{id}', 'API\UserController@updatePassword');

Route::apiResources(['todo' => 'API\TodoController']);
Route::put('dotodo/{id}', 'API\TodoController@do');
Route::put('undotodo/{id}', 'API\TodoController@undo');

Route::apiResources(['devdept' => 'API\DevDeptController']);

