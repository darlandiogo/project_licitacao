<?php

namespace App\Repositories;

use App\Models\PessoaJuridica;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaJuridicaRepository implements Repository
{
    public function all($params)
    {
        $query = DB::table('pessoas'); 
        $query->select(['pessoas.id', 'pessoas.name', 'pessoas.email']);
        $query->join('pessoa_juridicas', 'pessoa_juridicas.pessoa_id','=', 'pessoas.id');

        if($params['searchTerm'])
            $query->where('name', $params['searchTerm']);

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }
    
    public function getById($id)
    {
        return Pessoa::with('pessoa_juridica')
            ->with('address')->with('phones')->findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = Pessoa::create([
            'name' => $input['name'],
            // 'birth_date' => $input['birth_date'],
            'email' => $input ['email'],
        ]);

        PessoaJuridica::create([
            'pessoa_id' => $pessoa->id,
            'razao_social' => $input['razao_social'],
            'cnpj' => $input['cnpj'],
            'type' => $input['type']
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = Pessoa::find($id);
        if($pessoa){
            $pessoa->name = $input['name'];
            //$pessoa->birth_date = $input['birth_date'];
            $pessoa->email = $input ['email'];
            $pessoa->save();
        }

        $pessoa_fisica = PessoaJuridica::find($pessoa->id);
        if($pessoa_fisica){
            $pessoa_fisica->pessoa_id = $pessoa->id;
            $pessoa_fisica->razao_social   = $input['razao_social'];
            $pessoa_fisica->cnpj  = $input['cnpj'] ;
            $pessoa_fisica->type = $input['type'] ;
            $pessoa_fisica->save();
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        PessoaJuridica::where('id',$id)->delete();
        return true;
    }
}