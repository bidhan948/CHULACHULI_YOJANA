<?php

namespace App\Models\MalpotModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDetail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_malpot';

    protected $table = 'land_details';

    protected $fillable = [
        'old_vdc_mp',
        'old_ward',
        'new_vdc_mp',
        'new_ward',
        'land_area_type_id',
        'land_category_type_id',
        'land_type_id',
        'kitta_no',
        'naksa_no',
        'bigha_ropani',
        'kattha_aana',
        'dhur_paisa',
        'kanwa_dam',
        'meter_sq',
        'ft_sq',
        'land_owner_id',
        'is_active',
        'deactivate_reason'
    ];
}
