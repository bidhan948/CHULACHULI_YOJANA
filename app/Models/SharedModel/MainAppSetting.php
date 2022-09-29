<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Model;

class MainAppSetting extends Model
{
    protected $connection = 'mysql_shared';
    protected $table = 'setup_main_app';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'has_yojana',
        'has_nagadi',
        'has_sampatikar',
        'has_dainik',
        'has_krishi',
        'has_apangata',
        'has_naksa',
        'has_byabasaye',
        'has_malpot',
        'has_pis',
        'site_name',
        'number_of_ward',
    ];
    public $timestamps = false;
}
