<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use Illuminate\Support\facades\Auth;
use App\Address;

class AddressController extends Controller {

	public function index() {
		$address = (new Address)->all_get(Auth::id());
		return view('address.index', compact('address'));
	}

	public function edit($id) {
		$address = (new Address)->find_get($id);
		if ($address->user_id == Auth::id()) {
			return view('address/edit', compact('address'));
		} else {
			session()->flash('index_message', 'アクセスに失敗しました');
			return redirect('address/index');
		}
	}

	public function update(AddressRequest $request) {
		$id = $request->id;
		if ((new Address)->dbUpDate($request, $id)) {
			session()->flash('index_message', 'お届け先を編集しました');
			return redirect('address/index');
		} else {
			session()->flash('edit_message', '編集に失敗しました');
			return redirect('address/edit');
		}
		session()->flash('index_message', 'アクセスに失敗しました');
		return redirect('address/index');
	}

	public function register() {
		return view('address.register');
	}

	public function add(AddressRequest $request) {
		$user_id = Auth::id();
		if (isset($user_id)) {
			if ((new Address)->dbAdd($request)) {
				session()->flash('index_message', 'お届け先を登録しました');
				return redirect('address/index');
			} else {
				session()->flash('register_message', '同じ住所が登録されています');
				return redirect('address/register');
			}
		}
		session()->flash('index_message', '登録に失敗しました');
		return redirect('address/index');
	}

	public function delete(Request $request) {
		$id = $request->input('id');
		if ((new Address)->dbDelete($id)) {
			session()->flash('index_message', '削除しました');
		} else {
			session()->flash('index_message', '削除できません');
		}
		return redirect('address/index');
	}
}
