<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todos', 'TodoController@index');
Route::post('/todos', 'TodoController@store');
Route::get('/todos/{key}', 'TodoController@search');
Route::get('/todos/edit/{id}', 'TodoController@edit');
Route::put('/todos/update/{id}', 'TodoController@update');
Route::delete('/todos/delete/{id}', 'TodoController@destroy');
