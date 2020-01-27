<?php
Auth::routes();
Route::get('/', function() { return redirect('/home'); });

Auth::routes();
Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/', function () { return redirect('/index'); });
	Route::get('/index', 'Auth\ItemController@index');
	Route::get('/detail/{id}', 'Auth\ItemController@detail')->name('items.item_name');
	Route::get('/home', 'Auth\HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admins/home'); });
	Route::get('login', 'Admin\LoginController@indexLoginForm')->name('admins.login');
	Route::post('login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admins.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admins.home');
});
