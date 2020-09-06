<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use DB;
use App\User;
use App\Cart;
use App\Item;
use App\Payment;
use App\Purchase;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
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

	public function purchaseIndex() {
		$payments = (new Payment)->all_get(Auth::id());
		return view('user.purchase', compact('payments'));
	}

	public function purchaseDetail($id, $date) {
		$cart_id = (new Purchase)->all_get($id);
		$carts = (new Cart)->puchase_all($cart_id);
		foreach ($carts as $cart) {
			$items[] = (new Item)->find($cart->item_id);
		}
		return view('user.purchase_detail', compact('items', 'carts', 'date'));
	}

	public function cancel($id, $status) {
		if (Auth::check()) {
			if ($status == config('status.previous')) {
				$payment = Payment::find($id);
				if ($payment->user_id == Auth::id()) {
					$payment->status = config('status.cancellation');
					$payment->save();
					// 購入履歴内のステータス変更
					DB::transaction(function() use($payment) {
						$purchase = (new Purchase)->purchaseCancel($payment->id);
						// キャンセルした商品を在庫に戻す
						$item = (new Cart)->cancelItem($purchase);
					});
					Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
					\Stripe\Refund::create(array(
						'charge' => $payment->payment_code,
					));
					return redirect()->route('user.purchase')->with('index_message', '注文をキャンセルしました。');
				}
			} else {
				return redirect()->route('user.purchase')->with('index_message', 'キャンセルできません。処理は中断されました。');
			}
		} else {
			return redirect()->route('user.purchase')->with('index_message', 'キャンセルできません。不正なアクセスです。');
		}
	}
}
