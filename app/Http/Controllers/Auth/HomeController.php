<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller {
	public function __construct()
	{
		$this->middleware('auth:user');
	}

	public function index()
	{
		return view('home');
	}
}
