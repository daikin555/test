<?php

namespace App\Http\Requests;

use App\Item;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
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
			'image_file' => 'image',
        ];
	}

	public function attributes() {
		return [
			'image_file' => '添付',
		];
	}
}
