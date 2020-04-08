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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->prefix('v1')->group(function() {
    Route::middleware('api.auth')->group(function () {
        Route::resource('exams', 'ExamController')->except('create', 'edit');
        Route::resource('questions', 'QuestionController')->except('create', 'edit');
        Route::resource('results', 'ResultController')->except('create', 'edit', 'delete');

        // Authentication
        Route::get('logout', 'AuthController@logout');
        Route::post('me', 'AuthController@me');
    });

	Route::post('login', 'AuthController@login');
});
