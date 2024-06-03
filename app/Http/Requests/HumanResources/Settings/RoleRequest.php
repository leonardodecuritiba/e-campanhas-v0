<?php

namespace App\Http\Requests\HumanResources\Settings;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest {
	private $table = 'roles';

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
            'name'  => 'required|min:3|max:100|unique:'.$this->table.',name',
        ];

//		dd($rules);
		switch ( $this->method() ) {
			case 'GET':
			case 'DELETE':
				{
					return [];
				}
			case 'PUT':
			case 'PATCH':
                {
                    $rules['name'] .= ',' . $this->role . ',id';
                    return $rules;
                }
			case 'POST':
				{
					return $rules;
				}
			default:
				break;
		}
	}
}

