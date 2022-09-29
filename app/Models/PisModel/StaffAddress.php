<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAddress extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_address';

    protected $fillable = [
        'user_id',
        'p_province',
        't_province',
        'p_district',
        't_district',
        'p_municipality',
        't_municipality',
        'p_ward',
        't_ward',
        'p_ward_nep',
        't_ward_nep',
        'p_tole',
        't_tole',
        'p_tole_nep',
        't_tole_nep',
        'p_house_no',
        't_house_no',
        'p_house_no_nep',
        't_house_no_nep',
        'p_contact',
        't_contact',
        'email',
    ];
}
