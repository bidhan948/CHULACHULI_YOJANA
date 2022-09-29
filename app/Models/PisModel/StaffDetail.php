<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_details';

    protected $fillable = [
        'user_id',
        'poly_marriage',
        'poly_spouse_name',
        'foreign_spouse_apply',
        'fa_country',
        'fa_date',
        'fa2_country',
        'fa2_date',
        'loan',
        'loan_detail',
        'qualification'
    ];
}
