<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
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
            'number' => 'required',
            'specification' => 'required',
            'quantity' => 'required', 
            'unity'    => 'required', 
            'type'     => 'required',
            'type_id'  => 'required',
            'value'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'o campo é obrigatório',
            'specification.required' => 'o campo é obrigatório',
            'quantity.required'  => 'o campo é obrigatório',
            'unity.required'     => 'o campo é obrigatório',
            'type.required'      => 'o campo é obrigatório',
            'type_id.required'   => 'o campo é obrigatório',
            'value.required'     => 'o campo é obrigatório',
        ];
    }

    
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
