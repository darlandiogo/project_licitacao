<?php

namespace App\Repositories;
namespace App\Repositories;
use App\Models\PessoaFisica;

class PessoaFisicaRepository implements Repository
{
    public function all()
    {
        return PessoaFisica::with('pessoa')->get();
    }
    
    public function getById($id)
    {
        return PessoaFisica::with('pessoa')->findOrFail($id);
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