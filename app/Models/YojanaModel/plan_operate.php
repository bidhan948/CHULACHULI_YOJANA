<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plan_operate extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';
    
    protected $fillable = [
        'plan_id',
        'type_id',
        'entered_by'
    ];
}
