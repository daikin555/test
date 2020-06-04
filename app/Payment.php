<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Item;
use App\Cart;

class Payment extends Model  {
	protected $fillable = [
		//
	];

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

}
