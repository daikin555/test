<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;
use App\Item;

class Cart extends Model {

	use SoftDeletes;
	protected $fillable = ['user_id', 'item_id', 'stock'];
	protected $tabel = 'carts';

	public function item() {
		return $this->belongsTo('App\Item', 'item_id');
	}

	public function all_get($auth_id) {
		$carts = $this->where('user_id', $auth_id)->get();
		return $carts;
	}

	public function add_db($item_id, $add_stk) {
		$item = (new Item)->findOrFail($item_id);
		$stock = $item->stock;
		if ($stock <= 0 || $stock < $add_stk) {
			return false;
		} else {
			DB::transaction(function() use($item_id, $add_stk, $item) {
				$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['stock' => 0]);
				$cart->increment('stock', $add_stk);
				$item->decrement('stock', $add_stk);
				session()->forget('id');
				return true;
			});
		}
		return view('cart.index');
	}

	public function soft_delete_db($cart_id) {
		DB::transaction(function() use($cart_id) {
			$cart = $this->find($cart_id);
			if (is_null($cart)) {
				abort(404);
			}
			if ($cart->user_id == Auth::id()) {
				$item_id = $cart->item_id;
				$stk = $cart->stock;
				$cart->delete();
				$item = (new Item)->find($item_id);
				$item->increment('stock', $stk);
				return true;
			}
			return false;
		});
		return view('cart.index');
	}

	public function purchased($cart_id) {
			$cart = $this->find($cart_id);
			if (is_null($cart)) {
				abort(404);
			}
			if ($cart->user_id == Auth::id()) {
				$cart->delete();
				return true;
			}
			return false;
		}


	public function subtotal() {
		$result = $this->item->price * $this->stock;
		return $result;
	}
}
