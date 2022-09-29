<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contingency extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql_yojana';

    protected $fillable = ['percent', 'fiscal_year_id'];
}
