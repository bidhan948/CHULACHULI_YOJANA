<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDivisionWork extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_division_works';

    protected $fillable = [
        'user_id',
        'from_date',
        'to_date',
        'post_area',
        'work_area',
        'a_work',
        'b_work',
        'c_work',
        'd_work',
        'e_work',
        'remarks'
    ];
}
