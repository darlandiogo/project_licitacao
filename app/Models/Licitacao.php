<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Licitacao extends Model
{
    use SoftDeletes;
    protected $table = 'licitacoes';
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function getDatetimeOpenAttribute($value)
    {
        $d = new Carbon($value);
        return $d->toDateTimeLocalString();
    }

    public function getValueAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }
    
    public static function formatMoneyDb($str)
    {
        $str = number_format(( preg_replace('/[^0-9]/', '', $str) / 100), 2);
        $str = str_replace(',', '', $str);
        return $str;
    }

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
    public function licitacao_status()
    {
        return $this->belongsTo('App\Models\LicitacaoStatus');
    }

}
