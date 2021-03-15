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

Route::post('register', 'App\Http\Controllers\PassportAuthController@register');
Route::post('login', 'App\Http\Controllers\PassportAuthController@login');
 

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/todolists', 'App\Http\Controllers\TodolistController@getLists');
    Route::get('/todos/{id}', 'App\Http\Controllers\TodolistController@getTodos');

    Route::post('/todo', 'App\Http\Controllers\TodolistController@createTodo');
    Route::post('/todolist', 'App\Http\Controllers\TodolistController@createTodolist');
    Route::post('/completeTodo/{id}', 'App\Http\Controllers\TodolistController@completeTodo');
    Route::patch('/todo/{id}', 'App\Http\Controllers\TodolistController@updateTodo');
    Route::delete('/todolist/{id}', 'App\Http\Controllers\TodolistController@deleteTodolist');
    Route::delete('/todo/{id}', 'App\Http\Controllers\TodolistController@deleteTodo');

});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/