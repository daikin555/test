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
		$items = DB::table('items')->get();
		return view('items.index', ['items' => $items]);
	}

	public function detail(Request $request, $id) {
		session(['id' => $id]);
		$desc = (new Item)->findGet($id);
		return view('items.detail', ['item' => $desc]);
	}
}
