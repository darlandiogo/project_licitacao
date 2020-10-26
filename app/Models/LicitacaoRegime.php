<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class LicitacaoRegime extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function licitacao()
    {
        return $this->hasOne('App\Models\Licitacao');
    }
}
