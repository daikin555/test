<?php
namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Purchase extends Model {

	protected $fillable = ['user_id', 'cart_id', 'payment_id', 'quantity'];

	public function purchased($cart_id, $payment_id) {
		$cart = Cart::find($cart_id);
		$user_id = $cart->user_id;
		$quantity = $cart->stock;
		if (is_null($cart)) {
			abort(404);
		}
		if ($cart->user_id == Auth::id()) {
			$purchased = $this->create(compact('user_id', 'cart_id', 'payment_id', 'quantity'));
		}
	}

	public function all_get($id) {
		$purchases = $this->where('payment_id', $id)->get();
		foreach ($purchases as $purchase) {
			$cart_id[] = $purchase->cart_id;
		}
		return $cart_id;
	}

	public function purchaseCancel($payment_id) {
		$purchases = $this->where('payment_id', $payment_id)->get();
		foreach ($purchases as $item) {
			$item->status = config('status.cancellation');
			$item->save();
		}
		return $purchases;
	}
}
