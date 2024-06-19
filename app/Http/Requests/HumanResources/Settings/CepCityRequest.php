<?php

namespace App\Http\Requests\HumanResources\Settings;

use Illuminate\Foundation\Http\FormRequest;

class CepCityRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'state_id' => 'required|exists:cep_states,id'
        ];
    }
}

