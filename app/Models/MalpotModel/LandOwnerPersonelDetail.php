<?php

namespace App\Models\MalpotModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandOwnerPersonelDetail extends Model
{
    use HasFactory;
    protected $connection = 'mysql_malpot';

    protected $table = 'land_owner_personal_details';

    protected $fillable = [
        'name',
        'name_english',
        'father_name',
        'grandfather_name',
        'nationality_id',
        'gender',
        'job_id',
        'email',
        'contact',
        'land_owner_detail_id'
    ];

    protected $timestamp = false;
}
