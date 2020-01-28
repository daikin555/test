<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/home';

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function logout(Request $request) {
		auth()->logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect()->route('home');
	}
}
