<?php

namespace App\Repositories;

use App\Models\Pessoa;
use App\Models\PessoaFisica;
use Illuminate\Support\Facades\DB;

class PessoaFisicaRepository implements Repository
{
    public function all($params)
    {   
        $query = DB::table('pessoas'); 
        $query->select([
            'pessoas.id', 
            'pessoas.name', 
            'pessoa_fisicas.ci', 
            'pessoa_fisicas.cpf',
            'pessoa_fisicas.type',
            ]);
        
        $query->join('pessoa_fisicas', 'pessoa_fisicas.pessoa_id','=', 'pessoas.id');
        $query->where('pessoas.deleted_at', null);
        
        if($params['searchTerm'])
            $query->where('pessoas.name', 'like', '%' . $params['searchTerm'] . '%');

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }

    public function listPessoa ()
    {
        $query = DB::table('pessoa_fisicas'); 
        $query->select(['pessoa_fisicas.id', 'pessoas.name', 'pessoa_fisicas.cpf']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_fisicas.pessoa_id');
        $query->leftJoin('funcionarios',  'funcionarios.pessoa_fisica_id', '=', 'pessoa_fisicas.id');
        $query->where('pessoa_fisicas.deleted_at', null);
        return $query->get(); 
    }
    
    public function getById($id)
    {
        return Pessoa::with('pessoa_fisica')
            ->with('address')->with('phones')->findOrFail($id);
    }

    public function create($input)
    {
        $pessoa = ( new PessoaRepository )->create($input);

        $pessoa_fisica = PessoaFisica::create([
            'pessoa_id' => $pessoa->id,
            'ci' => $input['ci'],
            'cpf' => $input['cpf'],
            'type' => $input['type']
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        /*$pessoa = Pessoa::find($id);
        if($pessoa){
            $pessoa->name = $input['name'];
            $pessoa->birth_date = $input['birth_date'];
            $pessoa->email = $input ['email'];
            $pessoa->save();
        } */

        $pessoa = (new PessoaRepository)->getById($id);
        if($pessoa){
            (new PessoaRepository)->edit($input, $pessoa->id);
        }

        $pessoa_fisica = PessoaFisica::where('pessoa_id', $pessoa->id)->first();
        if($pessoa_fisica){
            $pessoa_fisica->ci   = $input['ci'];
            $pessoa_fisica->cpf  = $input['cpf'] ;
            $pessoa_fisica->type = $input['type'] ;
            $pessoa_fisica->save();
        }

        return $this->getById($pessoa->id);
    }

    public function delete($id)
    {
        PessoaFisica::where('id',$id)->delete();
        return true;
    }
}