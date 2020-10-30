<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public static function formatMoneyDb($str)
    {
        $str = number_format(( preg_replace('/[^0-9]/', '', $str) / 100), 2);
        $str = str_replace(',', '', $str);
        return $str;
    }
}
