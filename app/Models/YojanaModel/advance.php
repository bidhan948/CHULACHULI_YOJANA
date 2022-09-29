<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class advance extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';
    protected $fillable = [
        'plan_id',
        'peski_amount',
        'peski_given_date_nep',
        'peski_given_date_eng',
        'advance_paid_date_nep',
        'advance_paid_date_eng',
        'father_name',
        'g_father_name',
        'user_id',
        'remark'
    ];

    public function setPeskiGivenDateNepAttribute($value)
    {
        $this->attributes['peski_given_date_nep'] = $value;
        $this->attributes['peski_given_date_eng'] = convertBsToAd($value);
    }

    public function setAdvancePaidDateNepAttribute($value)
    {
        $this->attributes['advance_paid_date_nep'] = $value;
        $this->attributes['advance_paid_date_eng'] = convertBsToAd($value);
    }

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
    }
}
