<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ItemController extends Controller {
	public function index () {
		$var = 1;
		return view('item.index', ['var' => $var]);
	}

}
