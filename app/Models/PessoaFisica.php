<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PessoaFisica extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function funcionario()
    {
        return $this->hasOne('App\Models\Funcionario');
    }

    public function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa');
    }

    public static function listPessoaById($id)
    {
        $query = DB::table('pessoa_fisicas'); 
        $query->select(['pessoas.id', 'pessoas.name', 'pessoa_fisicas.cpf']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_fisicas.pessoa_id');
        //$query->leftJoin('funcionarios',  'funcionarios.pessoa_fisica_id', '=', 'pessoa_fisicas.id');
        $query->where('pessoas.id', $id);
        return $query->first();   
    }
    public static function listPessoa () {
        $query = DB::table('pessoa_fisicas'); 
        $query->select(['pessoas.id', 'pessoas.name', 'pessoa_fisicas.cpf']);
        $query->join('pessoas', 'pessoas.id','=', 'pessoa_fisicas.pessoa_id');
        $query->leftJoin('funcionarios',  'funcionarios.pessoa_fisica_id', '=', 'pessoa_fisicas.id');
        return $query->get();
    }
}
