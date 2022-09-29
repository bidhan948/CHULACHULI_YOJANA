<?php

namespace App\Models\YojanaModel\setting;

use App\Models\SharedModel\FiscalYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class decimal_point extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['fiscal_year_id', 'name'];

    public function fiscalYear(): HasOne
    {
        return $this->hasOne(FiscalYear::class,'id','fiscal_year_id');
    }
}
