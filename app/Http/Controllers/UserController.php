<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller {

	public function index() {
		$auth = Auth::user();
		return view('user.index', compact('auth'));
	}

	public function edit_name() {
		return view('user.edit_name');
	}

	public function name_update(Request $request) {
		validator()->validate($request->all(), [
			'name' => 'required|string',
			'password' => 'required|string|min:6',
		]);
		$id = Auth::id();
		if ((new User)->userCheck($request, $id)) {
			if((new User)->nameUp($request, $id)) {
				session()->flash('index_message', '名前を変更しました');
				return redirect('user/index');
			}
		} else {
			session()->flash('index_message', 'アクセスに失敗しました');
			return redirect('user/edit_name');
		}
	}

	public function edit_email() {
		return view('user.edit_email');
	}

	public function update_email(Request $request) {
		/*validator()->validate($request->all()), [
			'email' => '',
			'password' => 'required|string|min:6',
		]);
		$id = Auth::id();
		if ((new User)->userCheck($request, $id)) {
		if((new User)->*/
	}

	public function edit_password() {
		return view('user.check');
	}

	/*public function identification(Request $request) {
		$id = Auth::id();
		if ((new User)->userCheck($request, $id)) {
			switch (session('status')) {
				case 'name':
					session(['id' => $id]);
					return view('user.edit_name');
					break;
				case 'email':
					return view('user.edit_email');
					break;
				case 'password':
					session(['id' => $id]);
					return view('user.edit_password');
					break;
			}
		} else {
			return redirect('user/index');
		}
	}*/

	/*public function update_name(Request $request) {
		if ((new User)->nameUpdate($request, session('id'))) {
			session()->flash('index_message', '名前を変更しました');
			return redirect('user/index');
		} else {
			session()->flash('index_message', 'アクセスに失敗しました');
			return redirect('user/index');
		}
	}*/

		/*public function update_email() {
		}

		public function update_password() {
		}*/

}
