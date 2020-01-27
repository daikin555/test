<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admins/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function indexLoginForm()
	{
		return view('admin.login');
	}

	protected function guard()
	{
		return Auth::guard('admin');
	}

	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();
		$request->session()->flush();
		$request->session()->regenerate();

		return redirect('/admin/login');
	}
}
