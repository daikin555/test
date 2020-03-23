<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ChangeEmail;
use Illuminate\Support\facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmailReset extends Model {
	use Notifiable;

	protected $fillable = [
		'user_id',
		'new_email',
		'token',
	];

	/**
	 * メールアドレス確定メールを送信
	 *
	 * @param [type] $token
	 *
	 */
	public function sendEmailResetNotification($token) {
		$this->notify(new ChangeEmail($token));
	}

	/**
	 * 新しいメールアドレスあてにメールを送信する
	 *
	 * @param  \Illuminate\Notifications\Notification  $notification
	 * @return string
	 */
	public function routeNotificationForMail() {
		return $this->new_email;
	}


}
