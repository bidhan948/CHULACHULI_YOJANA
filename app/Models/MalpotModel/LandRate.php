<?php

namespace App\Models\MalpotModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandRate extends Model
{
    use HasFactory;
    protected $connection = 'mysql_malpot';

    protected $table = 'land_rates';

    protected $fillable = [
        'land_area_type_id',
        'land_category_type_id',
        'land_type_id',
        'rate',
        'fiscal_year_id',
        'is_active'
    ];

}
