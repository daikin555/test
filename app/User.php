<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PasswordResetNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class User extends Authenticatable {
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'token', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];


	public function sendPasswordResetNotification($token) {
		$this->notify(new PasswordResetNotification($token));
	}

	public function userCheck($request, $id) {
		$data = $this->find($id);
		$post_pass = $request->password;
		if (Hash::check($post_pass, $data->password)) {
			return true;
		} else {
			return false;
		}
	}

	public function nameUp($request, $id) {
		$data = $this->findOrFail($id);
		if ($data->id == Auth::id()) {
			$data->name = $request->input('name');
			$data->save();
			return true;
		} else {
			return false;
		}
	}

	public function passUp($request, $id) {
		$data = $this->findOrFail($id);
		if ($data->id == Auth::id()) {
			$data->password = Hash::make($request->input('new_password'));
			$data->save();
			return true;
		} else {
			return false;
		}
	}

	public function menberFind($id) {
		$dateils = $this->find($id);
		return $dateils;
	}
}
