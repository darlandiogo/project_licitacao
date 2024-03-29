<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class CotacaoRequest extends FormRequest
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
            'process_number'  => 'required',
            'process_date'    => 'required',
            'purpose_bidding' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'process_number.required'   => 'o campo é obrigatório',
            'process_date.required'  => 'o campo é obrigatório',
            'purpose_bidding.required' => 'o campo é obrigatório',
        ];
    }

     
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
