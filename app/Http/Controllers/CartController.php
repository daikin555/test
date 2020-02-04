<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Item;
use App\Cart;

class CartController extends Controller {

	public function index() {
		$carts = (new Cart)->all_get(Auth::id());
		$subtotals = $this->subtotals($carts);
		$totals = $this->totals($carts);
		if (is_null($carts)) {
			abort(404);
		}
		return view('cart.index', compact('carts', 'totals', 'subtotals'));
	}

	private function subtotals($carts) {
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}

	private function totals($carts) {
		$result = $this->subtotals($carts) + $this->tax($carts);
		return $result;
	}

	private function tax($carts) {
		$result = floor($this->subtotals($carts) * 0.1);
		return $result;
	}

	public function add() {
		$item_id = session('id');
		if (isset($item_id)) {
			if ((new Cart)->add_db($item_id, 1)) {
				session()->flash('add_message', '商品をカートに入れました');
			} else {
				session()->flash('add_message', '在庫が足りません');
			}
		}/* else {
			session()->flash('add_message', 'リロードはできません');
	}*/
			session()->forget('id');
			return $this->index();
	}

	public function delete(Request $request) {
		$cart_id = $request->input('cart_id');
		if ((new Cart)->soft_delete_db($cart_id)) {
			$request->session()->regenerateToken();
			session()->flash('del_message', 'カートから商品を削除しました');
		} else {
			session()->flash('del_message', 'リロードはできません');
		}
		return redirect('cart/index');
	}
}
