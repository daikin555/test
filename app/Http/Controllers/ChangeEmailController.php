<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Str;
use App\EmailReset;
use App\User;
use DB;
use Carbon\Carbon;


class ChangeEmailController extends Controller {

	public function sendChangeEmailLink(Request $request) {
		validator()->validate($request->all(), [
			'email' => 'required|email',
			'password' => 'required',
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
		return redirect('user/edit_email')->with('flash_message', 'パスワードが違います。');
	}

	public function reset(Request $request, $token) {
		$email_resets = EmailReset::where('token', $token)->first();

		// トークンが存在している、かつ、有効期限が切れていないかチェック
		if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {

			// ユーザーのメールアドレスを更新
			$user = User::find($email_resets->user_id);
			$user->email = $email_resets->new_email;
			$user->save();

			// レコードを削除
			DB::table('email_resets')
				->where('token', $token)
				->delete();

			return redirect('user/index')->with('flash_message', 'メールアドレスを更新しました！');
		} else {
			// レコードが存在していた場合削除
			if ($email_resets) {
				DB::table('email_resets')
					->where('token', $token)
					->delete();
			}
			return redirect('/home')->with('flash_message', 'メールアドレスの更新に失敗しました。');
		}
	}

	protected function tokenExpired($createdAt) {
		$expires = 60 * 30;
		return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
	}
}
