<?php

namespace App\Repositories;

use App\Models\PessoaFisica;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaFisicaRepository implements Repository
{
    public function all($params)
    {   
        $query = DB::table('pessoas'); 
        $query->select(['pessoas.id', 'pessoas.name', 'pessoas.email']);
        $query->join('pessoa_fisicas', 'pessoa_fisicas.pessoa_id','=', 'pessoas.id');

        if($params['searchTerm'])
            $query->where('name', $params['searchTerm']);

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }
    
    public function getById($id)
    {
        return Pessoa::with('pessoa_fisica')
            ->with('address')->with('phones')->findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = PessoaFisica::create([
            'pessoa_id' => $input['pessoa_id'],
            'ci' => $input['ci'],
            'cpf' => $input['cpf'],
            'type' => $input['type']
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = PessoaFisica::find($id);
        if($pessoa){
            $pessoa->pessoa_id = $input['pessoa_id'];
            $pessoa->ci   = $input['ci'];
            $pessoa->cpf  = $input['cpf'] ;
            $pessoa->type = $input['type'] ;
            $pessoa->save();
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        PessoaFisica::where('id',$id)->delete();
        return true;
    }
}