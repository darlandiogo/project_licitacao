<?php

namespace App\Repositories;

use App\Models\Funcionario;

class FuncionarioRepository implements Repository
{
    public function all($params)
    {
        return Funcionario::with('pessoa_fisica')->get();
    }
    
    public function getById($id)
    {
        return Funcionario::with('pessoa_fisica')->findOrFail($id);
    }

    public function create($input)
    {
        $funcionario = Funcionario::create([
            'pessoa_fisica_id' => $input['pessoa_fisica_id'],
            'matricula' => $input['matricula'],
            'type_contract' => $input['type_contract'],
            'role' => $input['role'],
            'sector' => $input['sector'],
            'portaria' => $input['portaria']
        ]);

        return $this->getById($funcionario->id);
    }

    public function edit($input, $id)
    {
        $funcionario = Funcionario::find($id);
        if($funcionario)
        {
            $funcionario->pessoa_fisica_id = $input['pessoa_fisica_id'];
            $funcionario->matricula   = $input['matricula'];
            $funcionario->type_contract  = $input['type_contract'] ;
            $funcionario->role = $input['role'] ;
            $funcionario->sector = $input['sector'] ;
            $funcionario->portaria = $input['portaria'] ;
            $funcionario->save();
        }

        return $this->getById($funcionario->id);
    }

    public function delete($id)
    {
        Funcionario::where('id',$id)->delete();
        return true;
    }   
}