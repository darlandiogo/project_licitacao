<?php

namespace App\Repositories;

use App\Models\PessoaJuridica;
use App\Models\Pessoa;
use App\Models\Representante;
use App\Models\PessoaFisica;
use App\Repositories\PessoaRepository;
use Illuminate\Support\Facades\DB;

class PessoaJuridicaRepository implements Repository
{
    public function all($params)
    {
        $query = DB::table('pessoas'); 
        $query->select([
            'pessoas.id', 
            'pessoas.name as nome_fantasia', 
            'pessoa_juridicas.razao_social', 
            'pessoa_juridicas.cnpj',
            'type'
            ]);
        
        $query->join('pessoa_juridicas', 'pessoa_juridicas.pessoa_id','=', 'pessoas.id');
        $query->where('pessoas.deleted_at', null);
        $query->where('type', '!=' ,'secretaria');
        
        if($params['searchTerm'])
            $query->where('pessoas.name', 'like', '%' . $params['searchTerm'] . '%');

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }

    public function getAllSecretaria($params)
    {
        $query = DB::table('pessoas'); 
        $query->select([
            'pessoas.id', 
            'pessoas.name as nome_fantasia', 
            'pessoa_juridicas.razao_social', 
            'pessoa_juridicas.cnpj',
            'type'
            ]);
        $query->join('pessoa_juridicas', 'pessoa_juridicas.pessoa_id','=', 'pessoas.id');
        $query->where('type', 'secretaria');

        if($params['searchTerm'])
            $query->where('pessoas.name', 'like', '%' . $params['searchTerm'] . '%');

        if($params['page'] && $params['perPage'])
            return $query->paginate($params['perPage'], ['*'], 'page', $params['page']);

        return $query->paginate(10);
    }

    public function listPessoaById($id)
    {
        $query = DB::table('pessoa_fisicas'); 
        $query->select(['pessoas.id', 'pessoas.name', 'pessoa_fisicas.cpf']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_fisicas.pessoa_id');
        //$query->leftJoin('funcionarios',  'funcionarios.pessoa_fisica_id', '=', 'pessoa_fisicas.id');
        $query->where('pessoas.id', $id);
        $query->where('pessoa_fisicas.deleted_at', null);
        return $query->first();   
    }
    
    public function getById($id)
    {
        $pessoa = Pessoa::with('pessoa_juridica')
            ->with('address')->with('phones')->findOrFail($id);

        $representantes = [];
        if($pessoa->pessoa_juridica)
        {
            $result = Representante::where('pessoa_juridica_id', $pessoa->pessoa_juridica->id)->get();
            foreach($result as $item){
                $value = $this->listPessoaById($item->pessoa_id );
                if($value)
                    $representantes[] = $value;
            }
        }

        $pessoa->representantes = $representantes;

        return $pessoa;

    }

    public function create($input)
    {
        $pessoa = ( new PessoaRepository )->create( $input );

        PessoaJuridica::create([
            'pessoa_id' => $pessoa->id,
            'razao_social' => $input['razao_social'] ? $input['razao_social'] : $input['name'],
            'cnpj' => $input['cnpj'],
            'type' => $input['type']
        ]);

        return $this->getById($pessoa->id);
    }

    public function edit($input, $id)
    {
        $pessoa = (new PessoaRepository)->getById($id);
        if($pessoa){
            (new PessoaRepository)->edit($input, $pessoa->id);
        }


        $pessoa_fisica = PessoaJuridica::where('pessoa_id', $pessoa->id)->first();
        if($pessoa_fisica){
            $pessoa_fisica->pessoa_id = $pessoa->id;
            $pessoa_fisica->razao_social   = $input['razao_social'] ? $input['razao_social'] : $input['name'];
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