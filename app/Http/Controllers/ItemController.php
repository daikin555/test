<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ItemController extends Controller {
	public function index () {
		$items = DB::table('items')->get();
		return view('items.index', ['items' => $items]);
	}
	public function detail(Request $request, $id) {
		$desc = DB::table('items')->where('id', '=', $id)->get();
		return view('items.detail', ['item' => $desc]);
	}

}
