<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';
    
    protected $fillable =[
        'plan_id',
        'has_deadline',
        'thekka_amount',
        'prakashit_date',
        'total_thekka_amount',
        'dakhila_date',
        'remarks',
    ];
}
