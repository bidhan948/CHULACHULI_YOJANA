<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contractKulLagat extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';

    protected $fillable= [
        'plan_id',
        'kabol_id',
        'physical_amount',
        'unit_id',
        'grant_amount',
        'total_kabol_amount',
        'contractor_name'
    ];



}
