<?php

namespace App\Http\Requests\HumanResources;

use Illuminate\Foundation\Http\FormRequest;

class VoterRequest extends FormRequest {
	private $table = 'voters';

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
            'surname'  => 'required|min:3|max:100',
            'name' => 'required|min:3|max:100',
        ];

//		dd($rules);
		switch ( $this->method() ) {
			case 'GET':
			case 'DELETE':
				{
					return [];
				}
			case 'POST':
				{

                    if($this->has('cnpj') && $this->get('cnpj') != NULL){
                        $rules['cnpj'] = 'min:1|max:20|unique:voters,cnpj';
                        unset($rules['cpf']);
                    }  else {
                        $rules['cpf'] = 'min:1|max:20|unique:voters,cpf';
                        unset($rules['cnpj']);
                    }

					return $rules;
				}
			case 'PUT':
			case 'PATCH':
				{
                    if($this->has('cnpj') && $this->get('cnpj') != NULL){
                        $rules['cnpj'] = 'required|min:3|max:20|unique:'.$this->table.',cnpj,' . $this->voter . ',id';
                        unset($rules['cpf']);
                    } else {
                        $rules['cpf'] = 'required|min:3|max:20|unique:'.$this->table.',cpf,' . $this->voter . ',id';
                        unset($rules['cnpj']);
                    }
					return $rules;
				}
			default:
				break;
		}
	}
}

