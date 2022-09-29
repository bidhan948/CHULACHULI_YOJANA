<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRawanaAbakas extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staff_rawana_awakas';

    protected $fillable = [
        'user_id',
        'rawana_date',
        'rawana_office',
        'rawana_remarks',
        'awakas_date',
        'awakas_remarks'
    ];

    public $timestamps = false;
}
