<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAward extends Model
{
    use HasFactory;

    protected $connection = 'mysql_pis';

    protected $table = 'staff_awards';

    protected $fillable = [
        'user_id',
        'award_detail',
        'received_date',
        'reason',
        'convenience'
    ];
}
