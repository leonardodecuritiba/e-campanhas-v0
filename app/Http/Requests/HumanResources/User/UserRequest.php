<?php

namespace App\Http\Requests\HumanResources\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest {
	private $table = 'users';

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
        $rules = [
            'name'  =>  'required|min:3|max:191',
        ];

		switch ( $this->method() ) {
			case 'GET':
			case 'DELETE':
				{
					return [];
				}
			case 'POST':
				{
					$rules['email'] = 'required|email|min:3|max:191|unique:users,email';
					$rules['password'] = 'required|min:3|max:32';
					return $rules;
				}
			case 'PUT':
			case 'PATCH':
				{
					return $rules;
				}
			default:
				break;
		}
	}
}

