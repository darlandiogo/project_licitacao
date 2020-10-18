<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddrressRequest extends FormRequest
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
            'pessoa_id'    => 'required',
            'address'      => 'required',
            'number'       => 'required',
            'neighborhood' => 'required',
            'postal_code'  => 'required',
            'city'         => 'required',
            'state'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pessoa_id.required' => 'o campo é obrigatório',
            'address.required'   => 'o campo é obrigatório',
            'number.required'    => 'o campo é obrigatório',
            'neighborhood.required' => 'o campo é obrigatório',
            'postal_code.required'  => 'o campo é obrigatório',
            'city.required'  => 'o campo é obrigatório',
            'state.required' => 'o campo é obrigatório',
        ];
    }
    
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
