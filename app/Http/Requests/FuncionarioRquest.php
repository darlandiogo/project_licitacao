<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FuncionarioRquest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pessoa_fisica_id' => 'required',
            'matricula'   => 'required',
            'type_contract'  => 'required', 
            'role'  => 'required', 
            'sector'  => 'required', 
            'portaria' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'pessoa_fisica_id.required' => 'o campo é obrigatório',
            'matricula.required'   => 'o campo é obrigatório',
            'type_contract.required'  => 'o campo é obrigatório',
            'role.required' => 'o campo é obrigatório',
            'sector.required'  => 'o campo é obrigatório',
            'portaria.required' => 'o campo é obrigatório',
        ];
    }

    
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
