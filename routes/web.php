<?php

Route::get('/index', 'ItemController@index');
Route::get('/detail/{id}', 'ItemController@detail')->name('item.name');

/*Route::group(['prefix' => 'admin'], function() {
	Route::get('/',         function () { return redirect('/admins/home'); });
	//Route::get('/login',     'Admin\LoginController@LoginForm')->name('admins.login');
	Route::post('/login',    'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admins'], function() {
	Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
	Route::get('home',      'Admin\HomeController@index')->name('admin.home');
});

/*Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
