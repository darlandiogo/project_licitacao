<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $guarded = [];

    public function funcionario()
    {
        return $this->hasOne('App\Models\Funcionario');
    }

    public function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa');
    }
}
