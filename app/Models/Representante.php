<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

}
