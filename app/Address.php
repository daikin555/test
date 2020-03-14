<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\Auth;
use App\Cart;

class Address extends Model {

	public $timestamps = false;

	protected $fillable = ['name', 'user_id', 'postcode', 'prefecture', 'city', 'block', 'md5', 'phone_number', 'data_delete'];
	protected $tabel = 'addresses';

	public function address() {
		return $this->belongsTo('App\Address', 'user_id');
	}

	private function totalAddress($request) {
		$total = $request->postcode . $request->prefecture . $request->city . $request->block;
		return $total;
	}

	private function sumAddress($request) {
		$count = $this->where('md5', $request->md5)->where('data_delete', null)->count();
		if (0 < $count) {
			return true;
		}
		return false;
	}

	public function all_get($auth_id) {
		$address = $this->where('user_id', $auth_id)->where('data_delete', null)->get();
		return $address;
	}

	public function find_get($id) {
		$address = $this->find($id);
		return $address;
	}

	public function edit_data($id) {
		$address = Address::find($id);
		return $address;
	}

	public function dbAdd($request) {
		$address = new Address;
		$request->user_id = Auth::id();
		$request->md5 = (new Address)->totalAddress($request);
		if ($this->sumAddress($request)) {
			return false;
		}
		$address->user_id = $request->user_id;
		$address->md5 = $request->md5;
		$address->fill($request->all())->save();
		return true;
	}

	public function dbUpDate($request, $id) {
		$data = $this->findOrFail($id);
		if ($data->user_id == Auth::id()) {
			$data->name = $request->input('name');
			$data->postcode = $request->input('postcode');
			$data->prefecture = $request->input('prefecture');
			$data->city = $request->input('city');
			$data->block = $request->input('block');
			$data->md5 = $this->totalAddress($request);
			$data->phone_number = $request->input('phone_number');
			$data->save();
			return true;
		} else {
			return false;
		}
	}

	public function dbDelete($id) {
		$delete = $this->findOrFail($id);
		if ($delete->user_id == Auth::id()) {
			$delete->data_delete = '1';
			$delete->save();
			return true;
		} else {
			return false;
		}
	}
}
