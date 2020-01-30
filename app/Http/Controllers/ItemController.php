<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller {
	public function index () {
		$items = DB::table('items')->get();
		return view('items.index', compact('items'));
	}
	public function detail(Request $request, $id) {
		$item = DB::table('items')->find($id);
		return view('items.detail', compact('item'));
	}

}
