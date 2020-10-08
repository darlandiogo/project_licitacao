<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $guarded = [];

    public function pessoa_fisica()
    {
        return $this->belongsTo('App\Models\PessoaFisica');
    }
}
