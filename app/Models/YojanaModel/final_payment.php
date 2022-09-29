<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class final_payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable =
    [
        'plan_id',
        'is_auto_calculate',
        'public_exam_date',
        'public_exam_date_eng',
        'public_group_count',
        'plan_end_date',
        'plan_end_date_eng',
        'assessment_date',
        'assessment_date_eng',
        'user_id',
        'type_accept_date',
        'type_accept_date_eng',
        'anugaman_accept_date',
        'anugaman_accept_date_eng',
        'hal_mulyankan',
        'evaluated_amount',
        'final_payable_amount',
        'payment_till_now',
        'advance_payment',
        'ghati_mulyankan_amount',
        'total_bhuktani_amount',
        'final_contingency_amount',
        'final_total_amount_deducted',
        'final_total_paid_amount',
        'user_id',
        'ip',
        'fiscal_id',
        'type_id'
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function finalPaymentDeatils(): HasMany
    {
        return $this->hasMany(final_payment_detail::class);
    }

    // overriding orm model to fill user_id
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    // setting nepali date to english
    public function setPublicExamDateAttribute($value)
    {
        $this->attributes['public_exam_date'] = $value;
        $this->attributes['public_exam_date_eng'] = convertBsToAd($value);
    }

    public function setPlanEndDateAttribute($value)
    {
        $this->attributes['plan_end_date'] = $value;
        $this->attributes['plan_end_date_eng'] = convertBsToAd($value);
    }

    public function setAssessmentDateAttribute($value)
    {
        $this->attributes['assessment_date'] = $value;
        $this->attributes['assessment_date_eng'] = convertBsToAd($value);
    }

    public function setTypeAcceptDateAttribute($value)
    {
        $this->attributes['type_accept_date'] = $value;
        $this->attributes['type_accept_date_eng'] = convertBsToAd($value);
    }

    public function setAnugamanAcceptDateAttribute($value)
    {
        $this->attributes['anugaman_accept_date'] = $value;
        $this->attributes['anugaman_accept_date_eng'] = convertBsToAd($value);
    }
}
