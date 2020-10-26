<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licitacao extends Model
{
    use SoftDeletes;
    protected $table = 'licitacoes';
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function licitacao_modality()
    {
        return $this->belongsTo('App\Models\LicitacaoModality');
    }
    public function licitacao_type()
    {
        return $this->belongsTo('App\Models\LicitacaoType');
    }
    public function licitacao_form()
    {
        return $this->belongsTo('App\Models\LicitacaoForm');
    }
    public function licitacao_regime()
    {
        return $this->belongsTo('App\Models\LicitacaoRegime');
    }

}
