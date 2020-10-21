<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Models\PessoaFisica;
use Illuminate\Support\Facades\DB;

class FuncionarioRepository implements Repository
{
    public function all($params)
    {
        //return Funcionario::with('pessoa_fisica')->get();

        $query = DB::table('pessoas'); 
        $query->select([
            'funcionarios.id', 
            'pessoas.name', 
            'pessoa_fisicas.ci',
            'pessoa_fisicas.cpf',
            'funcionarios.role',
            'funcionarios.portaria',
            ]);
        $query->join('pessoa_fisicas', 'pessoa_fisicas.pessoa_id','=', 'pessoas.id');
        $query->join('funcionarios',  'funcionarios.pessoa_fisica_id', '=', 'pessoa_fisicas.id');

        if($params['searchTerm'])
            $query->where('pessoas.name', 'like', '%' . $params['searchTerm'] . '%');

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }
    
    public function getById($id)
    {
        return Funcionario::findOrFail($id);
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
    
    public function listPessoa(){
        // * melhorar query pra trazer apenas pesso_fisica sem vinculo com funcionario
        return PessoaFisica::listPessoa();

    }
}