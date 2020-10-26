<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LicitacaoRequest extends FormRequest
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
            'process_number' => 'required',
            'process_date' => 'required',
            'bidding_number' => 'required',
            'modality'=> 'required',
            'type' => 'required',
            'form' => 'required',
            'regime' => 'required',
            'bidding_objective' => 'required',
            'justification' => 'required',
            'purpose_contract' => 'required',
            'way_execution' => 'required',
            'validity_contract' => 'required',
            'deadline_contract' => 'required',
            'general_considerations' => 'required',
            'bidding_organ'=> 'required',
            'emiter_name' => 'required',
            'emiter_office' => 'required',
            'disbursement_schedule' => 'required',
            'edital_date' => 'required',
            'datetime_open' => 'required',
            'status_process' => 'required',
            'sector_id' => 'required',
            'value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'process_number.required' => 'o campo é obrigatório',
            'process_date.required' => 'o campo é obrigatório',
            'bidding_number.required' => 'o campo é obrigatório',
            'modality.required' => 'o campo é obrigatório',
            'type.required' => 'o campo é obrigatório',
            'form.required' => 'o campo é obrigatório',
            'regime.required' => 'o campo é obrigatório',
            'bidding_objective.required' => 'o campo é obrigatório',
            'justification.required' => 'o campo é obrigatório',
            'purpose_contract.required' => 'o campo é obrigatório',
            'way_execution.required' => 'o campo é obrigatório',
            'validity_contract.required' => 'o campo é obrigatório',
            'deadline_contract.required' => 'o campo é obrigatório',
            'general_considerations.required' => 'o campo é obrigatório',
            'bidding_organ.required' => 'o campo é obrigatório',
            'emiter_name.required' => 'o campo é obrigatório',
            'emiter_office.required' => 'o campo é obrigatório',
            'disbursement_schedule.required' => 'o campo é obrigatório',
            'edital_date.required' => 'o campo é obrigatório',
            'datetime_open.required' => 'o campo é obrigatório',
            'status_process.required' => 'o campo é obrigatório',
            'sector_id.required' => 'o campo é obrigatório',
            'value.required' => 'o campo é obrigatório',
        ];
    }

    
    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
