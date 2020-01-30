<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;
use App\Item;

class Cart extends Model {

	use SoftDeletes; //ソフトデリート準備
	protected $fillable = ['user_id', 'item_id', 'stock'];
	protected $tabel = 'carts';

	public function item() {
		//リレーション
		return $this->belongsTo('App\Item', 'item_id');
	}
	public function all_get($auth_id) {
		//ログインユーザーのカートデータ読み込み
		$carts = $this->where('user_id', $auth_id)->get();
		return $carts;
	}
	public function add_db($item_id, $add_qty) {
		$item = (new Item)->findOrFail($item_id);
		$stock = $item->stock;
		//在庫なしバリデーション
		if ($stock <= 0 || $stock < $add_qty) {
			return false;
		}
		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['stock' => 0]);
		$cart->increment('stock', $add_qty);
		$item->decrement('stock', $add_qty);
		session()->forget('id');
		return true;
	}
	public function soft_delete_db($cart_id) {
		$cart = $this->find($cart_id);
		if ($cart->user_id == Auth::id()) {
			$item_id = $cart->item_id;
			$qty = $cart->stock;
			$cart->delete();
			$item = (new Item)->find($item_id);
			$item->increment('stock', $qty);
			return true;
		}
		return false;
	}
	public function subtotal() {
		$result = $this->item->price * $this->stock;
		return $result;
	}
}
