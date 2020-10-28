<?php

namespace App\Repositories;

use App\Models\Licitacao;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LicitacaoRepository implements Repository
{
    public function all($params)
    {
        $query = DB::table('licitacoes');
        $query->select(DB::raw("id, process_number, DATE_FORMAT(process_date,'%d/%m/%Y') AS process_date ,  bidding_number, bidding_objective, REPLACE(REPLACE(REPLACE(FORMAT(value, 2), '.', '#'), ',', '.'), '#', ',') as value"));
        if($params['searchTerm']){
            $query->where('process_number', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('bidding_number', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('process_date', 'like', '%' . $params['searchTerm'] . '%');
        }
        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }
    
    public function getById($id)
    {
        $licitacoes = Licitacao::with('licitacao_modality') 
        ->with('licitacao_modality') 
        ->with('licitacao_type') 
        ->with('licitacao_form') 
        ->with('licitacao_regime')  
        ->with('licitacao_status')
        ->findOrFail($id); 
       
        if($licitacoes)
            $licitacoes->items = DB::table('items')->where('type_id', $id)->get();

        return $licitacoes;
    }

    public function create($input)
    {
        $licitacao = Licitacao::create([
            'process_number'  => $input['process_number'],
            'process_date'    => $input['process_date'],
            'bidding_number'  => $input['bidding_number'],
            'licitacao_modality_id' => $input['modality'],
            'licitacao_type_id'     => $input['type'],
            'licitacao_form_id'     => $input['form'],
            'licitacao_regime_id'   => $input['regime'],
            'licitacao_status_id'   => $input ['status'], 
            'bidding_objective' => $input['bidding_objective'],
            'justification'     => $input['justification'],
            'purpose_contract'  => $input['purpose_contract'],
            'way_execution'     => $input['way_execution'],
            'validity_contract' => $input['validity_contract'],
            'deadline_contract' => $input['deadline_contract'],
            'general_considerations' => $input['general_considerations'],
            'bidding_organ'     => $input['bidding_organ'],
            'emiter_name'       => $input['emiter_name'],
            'emiter_office'     => $input['emiter_office'],
            'disbursement_schedule' => $input['disbursement_schedule'],
            'edital_date'       => $input['edital_date'],
            'datetime_open'     => new Carbon($input['datetime_open']),
            'sector_id'         => $input['sector_id'],
            'value'             => Licitacao::formatMoneyDb($input['value']),
        ]);

        return $this->getById($licitacao->id);
    }

    public function edit($input, $id)
    {   
        $licitacao = Licitacao::find($id);
        if($licitacao){
            $licitacao->process_number  = $input['process_number'];
            $licitacao->process_date    = $input['process_date'];
            $licitacao->bidding_number  = $input['bidding_number'];
            $licitacao->licitacao_modality_id = $input['modality'];
            $licitacao->licitacao_type_id     = $input['type'];
            $licitacao->licitacao_form_id     = $input['form'];
            $licitacao->licitacao_regime_id   = $input['regime'];
            $licitacao->licitacao_status_id   = $input['status'];
            $licitacao->bidding_objective = $input['bidding_objective'];
            $licitacao->justification     = $input['justification'];
            $licitacao->purpose_contract  = $input['purpose_contract'];
            $licitacao->way_execution     = $input['way_execution'];
            $licitacao->validity_contract = $input['validity_contract'];
            $licitacao->deadline_contract = $input['deadline_contract'];
            $licitacao->general_considerations = $input['general_considerations'];
            $licitacao->bidding_organ     = $input['bidding_organ'];
            $licitacao->emiter_name       = $input['emiter_name'];
            $licitacao->emiter_office     = $input['emiter_office'];
            $licitacao->disbursement_schedule = $input['disbursement_schedule'];
            $licitacao->edital_date       = $input['edital_date'];
            $licitacao->datetime_open     = new Carbon($input['datetime_open']);
            $licitacao->sector_id         = $input['sector_id'];
            $licitacao->value             =  Licitacao::formatMoneyDb($input['value']);
            $licitacao->save();
        }

        return $this->getById($licitacao->id);
    }

    public function delete($id)
    {
        //
    }

    public function selectOptions()
    {
        $list = [
            'modalities' => DB::table('licitacao_modalities')->get(),
            'types' => DB::table('licitacao_types')->get(),
            'forms' => DB::table('licitacao_forms')->get(),
            'regimes' => DB::table('licitacao_regimes')->get(),
            'status' => DB::table('licitacao_status')->get(),
        ];

        return $list;
    }
}