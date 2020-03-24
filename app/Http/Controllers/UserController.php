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
			'password' => 'required',
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

	public function edit_password() {
		return view('user.edit_password');
	}

	public function update_password(Request $request) {
		validator()->validate($request->all(), [
			'password' => 'required',
			'new_password' => 'required|string|min:6|confirmed',
		]);
		$id = Auth::id();
		if($request->password !== $request->new_password) {
			if ((new User)->userCheck($request, $id)) {
				if((new User)->passUp($request, $id)) {
					session()->flash('index_message', 'パスワードを変更しました');
					return redirect('user/index');
				} else {
					session()->flash('pass_message', 'アクセスに失敗しました');
					return redirect('user/edit_name');
				}
			}
			session()->flash('pass_message', '現在のパスワードが正しくありません。');
			return redirect('user/edit_password');
		}
		session()->flash('pass_message', '現在と同じパスワードは設定できません。');
		return redirect('user/edit_password');
	}
}
