<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Str;
use App\EmailReset;
use App\User;
use DB;


class ChangeEmailController extends Controller {

	public function sendChangeEmailLink(Request $request) {
		validator()->validate($request->all(), [
			'email' => 'required|email',
			'password' => 'required|string|min:6',
		]);

		$id = Auth::id();
		if ((new User)->userCheck($request, $id)) {
			$new_email = $request->email;

			// トークン生成
			$token = hash_hmac(
				'sha256',
				Str::random(40) . $new_email,
				config('app.key')
			);

			// トークンをDBに保存
			DB::beginTransaction();
			try {
				$param = [];
				$param['user_id'] = Auth::id();
				$param['new_email'] = $new_email;
				$param['token'] = $token;
				$email_reset = EmailReset::create($param);
				DB::commit();

				$email_reset->sendEmailResetNotification($token);
				return redirect('user/index')->with('flash_message', '確認メールを送信しました。');
			} catch (Exception $e) {
				DB::rollback();
				return redirect('user/index')->with('flash_message', 'メール更新に失敗しました。');
			}
		}
	}
}
