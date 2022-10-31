<?php

namespace App\Models\YojanaModel\program;

use App\Models\YojanaModel\plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class program_final_payment extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        "plan_id",
        "work_order_id",
        "paid_date",
        "paid_date_eng",
        "bill_amount",
        "bhuktani_ghati_katti_rakam",
        "program_advance",
        "total_katti_amount",
        "net_total_amount",
        "user_id",
        "is_final_payment",
        "fiscal_year_id"
    ];

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public function setPaidDateAttribute($value)
    {
        $this->attributes['paid_date'] = $value;
        $this->attributes['paid_date_eng'] = convertBsToAd($value);
    }

    public function programPaymentFinalDeduction(): HasMany
    {
        return $this->hasMany(program_payment_final_deduction::class);
    }

    public function Program(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }
}
