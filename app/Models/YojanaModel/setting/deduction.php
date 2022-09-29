<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class deduction extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $connection = 'mysql_yojana';
    protected $fillable = ['name', 'percent', 'is_active'];
}
