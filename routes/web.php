<?php
Auth::routes();
Route::get('/', function() { return redirect('/home'); });
Route::get('/', function () { return redirect('/items/index'); });
Route::get('/index', 'ItemController@index');
Route::get('/detail/{id}', 'ItemController@detail')->name('item.name');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/index', 'ItemController@index')->name('item.index');

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/cart/index', 'CartController@add')->name('cart.add');
	Route::post('/cart/index', 'CartController@delete')->name('cart.delete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:user'], function() {
	Route::post('logout', 'LoginController@logout')->name('logout');
	Route::get('home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('/index', 'Admin\ItemController@index')->name('items.index');
	Route::get('login', 'Admin\LoginController@indexLoginForm')->name('admins.login');
	Route::get('/detail/{id}', 'Admin\ItemController@detail')->name('items.name');
	Route::get('/edit', 'Admin\ItemController@edit')->name('items.edit');
	Route::post('/edit', 'Admin\ItemController@update')->name('items.edit');
	Route::post('login', 'Admin\LoginController@login');
	Route::post('/update', 'Admin\ItemController@add')->name('items.add');
	Route::get('/items/update', 'Admin\ItemController@create')->name('items.update');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admins.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admins.home');
});

Route::post('qr-bot', 'QrBotController@reply');
