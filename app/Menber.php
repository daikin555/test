<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class Menber extends Authenticatable {

	protected $fillable = ['name', 'email', 'password'];
	protected $hidden = ['password', 'remember_token'];

	/*public function user() {
		return $this->belongsTo('App\User', 'item_id');
	}*/

	public function () {
	}
}
