<?php

Route::get('/index', 'ItemController@index');
Route::get('/detail/{id}/item_name', 'ItemController@detail')->name('items.item_name');
/*Route::get('/', function () {
	return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
