<?php
Auth::routes();
Route::get('/', function() { return redirect('/home'); });

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/', function () { return redirect('/items/index'); });
	Route::get('/index', 'Auth\ItemController@index');
	Route::get('/detail/{id}', 'Auth\ItemController@detail')->name('item.name');
	Route::get('/home', 'Auth\HomeController@index')->name('home');
	Route::get('/index', 'Auth\ItemController@index')->name('item.index');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:user'], function() {
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('home', 'HomeController@index')->name('home');
});

	Route::group(['prefix' => 'admin'], function() {
		Route::get('/', function () { return redirect('/admin/home'); });
		Route::get('/index', 'Admin\Auth\ItemController@index')->name('items.index');
		Route::get('login', 'Admin\LoginController@indexLoginForm')->name('admins.login');
		Route::get('/detail/{id}', 'Admin\Auth\ItemController@detail')->name('items.name');
		Route::get('/edit', 'Admin\Auth\ItemController@edit')->name('items.edit');
		Route::post('/edit', 'Admin\Auth\ItemController@update')->name('items.edit');
		Route::post('login', 'Admin\LoginController@login');
		Route::post('/update', 'Admin\Auth\ItemController@add')->name('items.add');
		Route::get('/items/update', 'Admin\Auth\ItemController@create')->name('items.update');
		//Route::post('/home', 'HomeController@index')->name('admins.home');
	});

	Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
		Route::post('logout', 'Admin\LoginController@logout')->name('admins.logout');
		Route::get('home', 'Admin\HomeController@index')->name('admins.home');
	});
