<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;

    protected $connection = 'mysql_shared';
    protected $fillable = ['name','name_eng','address'];
}
