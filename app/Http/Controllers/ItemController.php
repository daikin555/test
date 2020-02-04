<?php

namespace App\Http\Controllers;

use DB;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ItemController extends Controller {
	public function index () {
		session(['id' => '']);
		$items = Item::all();
		return view('items.index', compact('items'));
	}
	public function detail(Request $request, $id) {
		session(['id' => $id]);
		$desc = Item::find($id);
		if (is_null($desc)) {
			abort(404);
		}
		return view('items.detail', ['item' => $desc]);
	}

}
