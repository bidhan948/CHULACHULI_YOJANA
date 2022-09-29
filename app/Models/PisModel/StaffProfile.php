<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffProfile extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_profiles';

    protected $fillable = [
        'user_id',
        'gender',
        'religion',
        'ethnicity',
        'face',
        'blood_group',
        'source',
        'janjati',
        'janjati_other',
        'madesi',
        'madesi_other',
        'dalit',
        'dalit_other',
        'low',
        'low_other',
        'disable',
        'disable_other',
        'is_division',
        'local_language'
    ];
}
