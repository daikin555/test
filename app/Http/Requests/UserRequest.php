<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required|string',
			//'email' => 'required|email',
			'password' => 'required|string|min:6',
			//'new_password' => 'required|string|min:6|confirmed'
		];
	}

	public function attributes() {
		return [
			'name' => '名前',
			'email' => 'メールアドレス',
			'password' => 'パスワード',
			'new_password' => 'パスワード'
		];
	}

	/*public function messages() {
		return [
			'required' => '※:attributeは必須項目です',
			'min:6' => '※attributeは6文字以上です'
		];
	}*/
}
