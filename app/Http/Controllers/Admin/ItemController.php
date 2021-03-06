<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use DB;
use App\Item;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ItemController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	public function index() {
		session(['id' => '']);
		$items = DB::table('items')->get();
		return view('admins.items.index', compact('items'));
	}

	public function detail(Request $request, $id) {
		session(['id' => $id]);
		$item = DB::table('items')->find($id);
		return view('admins.items.detail', compact('item'));
	}

	public function edit(Request $request) {
		$id = session('id');
		$item = DB::table('items')->find($id);
		return view('admins.items.edit', compact('item'));
	}

	public function create() {
		return view('admins.items.update');
	}

	public function add(ItemRequest $request) {
		(new Item)->createDb($request);
		session()->flash('add_message', '商品を追加しました');
		return redirect(route('items.index'));
	}

	public function update(ItemRequest $request) {
		$id = session('id');
		(new Item)->updateDb($id, $request);
		session()->flash('edit_message', '商品を編集しました');
		return redirect(route('items.name', ['id' => $id]));
	}

	public function img(Request $request, $item_id) {
		if (session('id') == $item_id) {
			return view('admins.items.img', compact('item_id'));
		} else {
			session()->flash('add_message', 'アクセスに失敗しました');
			return redirect(route('items.index'));
		}
	}

	public function add_img(ImageRequest $request, $item_id) {
		if (session('id') == $item_id) {
			if ($request->isMethod('POST')) {
				(new Item)->updateImg($request, $item_id);
				return redirect(route('items.index'))->with(['success'=> 'ファイルを保存しました']);
			}
			return redirect(route('admins.items.img', compact('item_id')));
		}
		session()->flash('add_message', 'アクセスに失敗しました');
		return redirect(route('items.index'));
	}
}
