<?php

namespace App\Http\Controllers\Admin\Auth;

use DB;
use App\Item;
use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ItemController extends Controller {
	public function index () {
		session(['id' => '']);
		$items = DB::table('items')->get();
		return view('admins.items.index', compact('items'));
	}

	public function detail(Request $request, $id) {
		session(['id' => $id]);
		$item = (new Item)->findGet($id);
		return view('admins.items.detail', compact('item'));
	}

	public function edit(Request $request) {
		$id = session('id');
		$item = (new Item)->findGet($id);
		return view('admins.items.edit', compact('item'));
	}

	public function create() {
		return view('admins.items.update');
	}

	public function add(Request $request) {
		(new Item)->createDb($request);
		session()->flash('add_message', '商品を追加しました');
		return redirect(route('items.index'));
	}

	public function update(Request $request) {
		$id = session('id');
		(new Item)->updateDb($id, $request);
		session()->flash('edit_message', '商品を編集しました');
		return redirect(route('items.name', ['id' => $id]));
	}
}
