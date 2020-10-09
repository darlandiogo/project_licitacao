<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PessoaJuridicaRequest extends FormRequest
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
            'pessoa_id' => 'required',
            'razao_social'   => 'required',
            'cnpj'  => 'required', 
            'type' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'pessoa_id.required' => 'o campo é obrigatório',
            'razao_social.required'   => 'o campo é obrigatório',
            'cnpj.required'  => 'o campo é obrigatório',
            'type.required' => 'o campo é obrigatório',
        ];
    }

    
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
