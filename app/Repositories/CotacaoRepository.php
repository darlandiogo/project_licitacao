<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\Cotacao;

class CotacaoRepository implements Repository
{
    public function all($params)
    {
        $query = DB::table('cotacoes');
        $query->select(DB::raw("id, process_number, DATE_FORMAT(process_date,'%d/%m/%Y') AS process_date, purpose_bidding"));
        $query->where('deleted_at', null);
        if($params['searchTerm']){
            $query->where('process_number', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('purpose_bidding', 'like', '%' . $params['searchTerm'] . '%');
            $query->orWhere('process_date', 'like', '%' . $params['searchTerm'] . '%');
        }
        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }
    
    public function getById($id){
        return Cotacao::findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = Cotacao::create([
            'process_number'  => $input['process_number'],
            'process_date'    => $input['process_date'],
            'purpose_bidding' => $input['purpose_bidding'],
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = Cotacao::find($id);
        if($pessoa)
        {
            $pessoa->process_number  = $input['process_number'];
            $pessoa->process_date    = $input['process_date'];
            $pessoa->purpose_bidding = $input['purpose_bidding'];
            $pessoa->save();
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        Cotacao::where('id',$id)->delete();
        return true;
    }

    public function listEmpresa()
    {
        $query = DB::table('pessoa_juridicas');
        $query->select(['pessoa_juridicas.id', 'pessoas.name', 'pessoa_juridicas.cnpj']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_juridicas.pessoa_id');
        $query->where('pessoa_juridicas.deleted_at', null);
        $query->where('type', '!=' ,'secretaria');
        return $query->get();
    }
}