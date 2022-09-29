<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffService extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_services';

    protected $fillable = [
        'user_id',
        'service',
        'office_group',
        'office_subgroup',
        'position',
        'level',
        'office_name_address',
        'office_name_address_english',
        'new_appoint',
        'decision_date',
        'restoration_date',
        'is_active'
    ];
}
