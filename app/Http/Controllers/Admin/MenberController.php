<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Address;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class MenberController extends Controller {

	public function __construct() {
		$this->middleware('auth:admin');
	}

	public function index() {
		$menbers = DB::table('users')->get();
		return view('admins.index', compact('menbers'));
	}

	public function detail($id) {
		$details = (new User)->menberFind($id);
		$address = (new Address)->all_get($id);
		return view('admins.detail', compact('details', 'address'));
	}
}
