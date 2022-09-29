<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTraining extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_trainings';

    protected $fillable = [
        'user_id',
        'detail',
        'date',
        'type',
        'institute',
        'created_by'
    ];
}
