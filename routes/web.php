<?php
Route::get('/index', 'ItemController@index');
Route::get('/detail/{id}', 'ItemController@detail')->name('items.item_name');
/*Route::get('/', function () {
		return view('welcome');
});*/
Auth::routes();
Route::get('/', function() { return redirect('/home'); });

Auth::routes();
Route::group(['middleware' => 'auth:user'], function() {
	Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@indexLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});
