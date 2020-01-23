<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller {
	public function index () {
		$var = 555;
		return view('index')->with(['var' => $var]);
	}
}
