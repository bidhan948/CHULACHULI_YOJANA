<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAppointment extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_appointments';

    protected $fillable = [
        'user_id',
        'office_name_address',
        'appoint_date',
        'decision_date',
        'attend_date',
        'service',
        'office_group',
        'office_subgroup',
        'level',
        'position',
        'technical'
    ];
}
