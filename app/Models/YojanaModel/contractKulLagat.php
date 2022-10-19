<?php

namespace App\Models\YojanaModel;

use App\Models\SharedModel\SettingValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class contractKulLagat extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';

    protected $fillable= [
        'plan_id',
        'kabol_id',
        'physical_amount',
        'unit_id',
        'grant_amount',
        'total_kabol_amount',
        'contractor_name'
    ];

    public function Unit() : BelongsTo
    {
        return $this->belongsTo(SettingValue::class,'unit_id','id');
    }
}
