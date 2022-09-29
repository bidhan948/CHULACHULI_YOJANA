<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\YojanaModel\plan;
use Illuminate\Database\Eloquent\Relations\HasMany;

class running_bill_payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'plan_id',
        'type_id',
        'period',
        'is_auto_calculate',
        'bill_date_nep',
        'bill_date_eng',
        'est_amount',
        'plan_evaluation_amount',
        'plan_own_evaluation_amount',
        'payable_amount',
        'peski_amount',
        'contingency_amount',
        'total_katti_amount',
        'total_paid_amount',
        'bill_payable_date',
        'bill_payable_date_eng',
        'user_id',
        'ip'
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }

    public function runningBillPaymentDetails(): HasMany
    {
        return $this->hasMany(running_bill_payment_detail::class);
    }

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public function setBillDateNepAttribute($value)
    {
        $this->attributes['bill_date_nep'] = $value;
        $this->attributes['bill_date_eng'] = convertBsToAd($value);
    }

    public function setBillPayableDateAttribute($value)
    {
        $this->attributes['bill_payable_date'] = $value;
        $this->attributes['bill_payable_date_eng'] = convertBsToAd($value);
    }
}
