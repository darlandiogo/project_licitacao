<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\Phone');
    }

    public function pessoa_fisica()
    {
        return $this->hasOne('App\Models\PessoaFisica');
    }
    public function pessoa_juridica()
    {
        return $this->hasOne('App\Models\PessoaJuridica');
    }
  
}
