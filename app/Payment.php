<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Item;
use App\Cart;

class Payment extends Model  {
	protected $fillable = ['user_id', 'address', 'amount', 'payment_code'];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function item() {
		return $this->belongsTo('App\Item', 'item_id');
	}

	public function stockAllSum($id) {
		$result = Cart::where('user_id', $id)->sum('stock');
		return $result;
	}

	public function purchaseData($user_id, $address, $payment_code, $amount) {
		$payment = $this->create(compact('user_id', 'address', 'payment_code', 'amount'));
		return $payment;
	}

	public function all_get($id) {
		$payments = $this->where('user_id', $id)->orderBy('created_at', 'desc')->get();
		return $payments;
	}
}

