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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'death' => $this->has('death'),
        ]);
    }

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
        $rules = [
            'name' => 'required|min:3|max:191',
            'surname'  => 'nullable|min:3|max:191',
            'location_of_operation'  => 'nullable|min:1|max:191',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'cpf'  => 'nullable|min:1|max:191',
        ];

        /*
         * Se tiver birthday, a years_approximate fica oculto e vice-versa. São campos OU-EXCLUSIVO,
         * se um for preenchido, o outro é zerado
         */
        if($this->has('birthday') && $this->get('birthday') != "") {
            $rules['birthday'] = 'required|date_format:dmY|before_or_equal:today';
        } else {
            $rules['years_approximate'] = 'required|between:1,150';
        }

        /*
         * Se campo death for marcado (checkbox), o campo death_date deve aparecer e se tornar obrigatório. Se death
         * estiver desmarcado o campo death_date recebe NULL.
         */
        if($this->has('death') && $this->get('death') != "") {
            $rules['death_date'] = 'required|date_format:dmY|before_or_equal:today';
        }

		switch ( $this->method() ) {
			case 'GET':
			case 'DELETE':
				{
					return [];
				}
			case 'POST': //store
				{
					return $rules;
				}
			case 'PUT':
			case 'PATCH': //update
				{
                    $rules['latitude'] = 'required|numeric|between:-90,90';
                    $rules['longitude'] = 'required|numeric|between:-180,180';
					return $rules;
				}
			default:
				break;
		}
	}
}

