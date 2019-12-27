<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン時
Route::group(['middleware' => 'auth'], function(){

    Route::resource('todo', 'Todo_itemsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

    Route::post('todo/create','Todo_itemsController@create');

    Route::post('todo/{todo}', 'Todo_itemsController@finish');

    Route::post('todo/store', 'Todo_itemsController@store');

    // Route::post('todo/{todo_item_id}/{todo_item?}', 'Todo_itemsController@update') ->name('update');

    Route::put('todo/{todo}/edit', 'Todo_itemsController@edit') ->name('edit');

    Route::delete('todo/{todo}', 'Todo_itemsController@destroy') ->name('delete');

});
