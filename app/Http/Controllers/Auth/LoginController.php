<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/index';

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function logout(Request $request){
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect()->route('login');
	}
}
