<?php

namespace App\Models\YojanaModel\program;

use App\Models\YojanaModel\plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class program_add_deadline extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';

    protected $fillable =
    [
        'plan_id',
        'work_order_id',
        'period',
        'letter_date_nep',
        'letter_date_eng',
        'institution_date_add_nep',
        'institution_date_add_eng',
        'period_add_date_nep',
        'period_add_date_eng',
        'remark',
        'user_id',
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(work_order::class);
    }

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
    }

    public function setLetterDateNepAttribute($value)
    {
        $this->attributes['letter_date_nep'] = $value;
        $this->attributes['letter_date_eng'] = convertBsToAd($value);
    }

    public function setInstitutionDateAddNepAttribute($value)
    {
        $this->attributes['institution_date_add_nep'] = $value;
        $this->attributes['institution_date_add_eng'] = convertBsToAd($value);
    }

    public function setPeriodAddDateNepAttribute($value)
    {
        $this->attributes['period_add_date_nep'] = $value;
        $this->attributes['period_add_date_eng'] = convertBsToAd($value);
    }
}
