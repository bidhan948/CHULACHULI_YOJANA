<?php

namespace App\Models\PisModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;
    protected $connection = 'mysql_pis';

    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'name',
        's_no',
        'nep_name',
        'dob',
        'cs_no',
        'cs_district',
        'cs_issue',
        'father_name',
        'father_nep_name',
        'father_occupation',
        'g_father_name',
        'g_father_nep_name',
        'g_father_occupation',
        'mother_name',
        'mother_nep_name',
        'mother_occupation',
        'spouse_name',
        'spouse_nep_name',
        'spouse_occupation',
        'daughters_no',
        'sons_no',
        'category_id',
        'sub_category_id',
        'photo',
        'pos'
    ];


    // added by YOJANA branch
    public function staffService(): HasOne
    {
        return $this->hasOne(StaffService::class, 'user_id', 'user_id')->where('is_active', 1);
    }
}
