<?php

namespace App\Repositories;

use App\Models\PessoaJuridica;


class PessoaJuridicaRepository implements Repository
{
    public function all($params)
    {
        return PessoaJuridica::with('pessoa')->get();
    }
    
    public function getById($id)
    {
        return PessoaJuridica::with('pessoa')->findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = PessoaJuridica::create([
            'pessoa_id' => $input['pessoa_id'],
            'razao_social' => $input['razao_social'],
            'cnpj' => $input['cnpj'],
            'type' => $input['type']
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = PessoaJuridica::find($id);
        if($pessoa){
            $pessoa->pessoa_id = $input['pessoa_id'];
            $pessoa->razao_social   = $input['razao_social'];
            $pessoa->cnpj  = $input['cnpj'] ;
            $pessoa->type = $input['type'] ;
            $pessoa->save();
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        PessoaJuridica::where('id',$id)->delete();
        return true;
    }
}