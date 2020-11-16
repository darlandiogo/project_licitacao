<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\CotacaoEmpresa;

class CotacaoEmpresaRepository implements Repository
{
    public function all($params)
    {
        //
    }
    
    public function getById($id)
    {
        $query = DB::table('pessoa_juridicas');
        $query->select(['pessoa_juridicas.id', 'pessoas.name', 'pessoa_juridicas.cnpj']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_juridicas.pessoa_id');
        $query->join('cotacao_empresas', 'cotacao_empresas.pessoa_juridica_id', '=', 'pessoa_juridicas.id');
        $query->where('cotacao_empresas.deleted_at', null);
        $query->where('type', '!=' ,'secretaria');
        $query->where('cotacao_id', $id);
        return $query->get();
    }

    public function create($input)
    {
        CotacaoEmpresa::create([
            'pessoa_juridica_id' => $input['pessoa_juridica_id'],
            'cotacao_id' => $input['cotacao_id'],
        ]);

        return $this->getById($input['cotacao_id']);
    }

    public function edit($input, $id)
    {   
        $arr = [];
        foreach($input['pessoa_juridica'] as $pessoa_juridica)
        {
            $arr [] = $pessoa_juridica['id'];
        }

        $result =  CotacaoEmpresa::whereNotIn('pessoa_juridica_id', $arr)->get();
        if($result[0])
            CotacaoEmpresa::where('id',$result[0]->id)->delete();   

        return $this->getById($id);
        
    }

    public function delete($id)
    {

        
    }
}