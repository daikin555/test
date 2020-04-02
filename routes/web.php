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

	Route::get('/address/index', 'AddressController@index')->name('address.index');
	Route::get('/address/edit/{id}', 'AddressController@edit')->name('address.edit');
	Route::post('/address/update', 'AddressController@update')->name('address.update');
	Route::get('/address/register', 'AddressController@register')->name('address.register');
	Route::post('/address/add', 'AddressController@add')->name('address.add');
	Route::get('/address/delete', 'AddressController@delete')->name('address.delete');

	Route::get('/user/index', 'UserController@index')->name('user.index');
	Route::get('/user/edit_name', 'UserController@edit_name')->name('user.edit_name');
	Route::get('/user/edit_email', 'UserController@edit_email')->name('user.edit_email');
	Route::get('/user/edit_password', 'UserController@edit_password')->name('user.edit_password');
	Route::post('/user/name', 'UserController@name_update')->name('user.name');
	Route::post('/send/email', 'ChangeEmailController@sendChangeEmailLink')->name('send.email');
	Route::get('reset/{token}', 'ChangeEmailController@reset');
	Route::post('/user/password', 'UserController@update_password')->name('update.password');
});

// 管理者側
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
	Route::get('/items/img/{item_id}', 'Admin\ItemController@img')->name('items.img');
	Route::post('/items/img/add/{item_id}', 'Admin\ItemController@add_img')->name('items.add_img');

	Route::get('/menber', 'Admin\MenberController@index')->name('menber.index');
	Route::get('/menber/detail/{id}', 'Admin\MenberController@detail')->name('menber.detail');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admins.logout');
	Route::get('home', 'Admin\HomeController@index')->name('admins.home');
});
