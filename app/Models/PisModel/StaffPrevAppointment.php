<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPrevAppointment extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_prev_appointments';

    protected $fillable = [
        'user_id',
        'office_name_address',
        'service',
        'office_group',
        'office_subgroup',
        'level',
        'position',
        'technical',
        'leave_date',
        'leave_reason'
    ];
}
