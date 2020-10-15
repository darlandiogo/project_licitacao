<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function pessoa_fisica()
    {
        return $this->belongsTo('App\Models\PessoaFisica');
    }
}
