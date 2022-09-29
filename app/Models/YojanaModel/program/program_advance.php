<?php

namespace App\Models\YojanaModel\program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class program_advance extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'work_order_id',
        'name',
        'father_name',
        'g_father_name',
        'amount',
        'advance_given_date_nep',
        'advance_given_date_eng',
        'advance_paid_date_nep',
        'advance_paid_date_eng',
        'remark',
        'user_id',
        'plan_id'
    ];

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
    }

    public function setAdvanceGivenDateNepAttribute($value)
    {
        $this->attributes['advance_given_date_nep'] = $value;
        $this->attributes['advance_given_date_eng'] = convertBsToAd($value);
    }

    public function setAdvancePaidDateNepAttribute($value)
    {
        $this->attributes['advance_paid_date_nep'] = $value;
        $this->attributes['advance_paid_date_eng'] = convertBsToAd($value);
    }

    public function workOrder() : BelongsTo
    {
        return $this->belongsTo(work_order::class);
    }
}
