<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLeave extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_leaves';

    protected $fillable = [
        'user_id',
        'session',
        'detail',
        'home_prev_left',
        'home_new',
        'home_total',
        'home_cost',
        'home_left',
        'sick_prev_left',
        'sick_new',
        'sick_total',
        'sick_cost',
        'sick_left',
        'delivery_total',
        'delivery_cost',
        'delivery_left',
        'study_total',
        'study_cost',
        'study_left',
        'uncommon_total',
        'uncommon_cost',
        'uncommon_left',
        'bedroom_total',
        'bedroom_cost',
        'bedroom_left',
        'from_date',
        'to_date',
        'to_from_total',
        'kyabi_total',
        'kyabi_cost',
        'kyabi_left',
        'pabi_total',
        'pabi_cost',
        'pabi_left',
        'mc_amount',
        'remarks'
    ];
}
