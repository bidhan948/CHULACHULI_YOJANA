<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anugaman_detail_plan extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_yojana';

    protected $fillable = ['anugaman_samiti_detail_id', 'plan_id'];
}
