<?php

namespace App\Http\Requests;

use App\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest {
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
			'postcode' => 'required|numeric|digits:7',
			'prefecture' => 'required|string',
			'city' => 'required|string',
			'block' => 'required|string',
			'phone_number' => 'required|numeric|digits_between:8,11'
		];
	}

	public function attributes() {
		return [
			'name' => '宛名',
			'postcode' => '郵便番号',
			'prefecture' => '都道府県',
			'city' => '市区町村',
			'block' => '番地・ビル名等',
			'phone_number' => '電話番号'
		];
	}

	public function messages() {
		return [
			'required' => '※:attributeは必須項目です',
			'postcode.digits' => '※郵便番号は7文字の数字です',
			'numeric' => '※:attributeは数字のみす',
			'phone_number.digits_between' => '※電話番号は11文字までの数字です'
		];
	}
}
