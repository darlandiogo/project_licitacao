<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $guarded = [];

    public function pessoa()
    {
        return $this->belongsTo('App\Models\Pessoa');
    }
}
