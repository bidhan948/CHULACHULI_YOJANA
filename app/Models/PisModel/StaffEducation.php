<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffEducation extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_educations';

    protected $fillable = [
        'user_id',
        'qualification',
        'subject',
        'year',
        'position',
        'institute'
    ];
}
