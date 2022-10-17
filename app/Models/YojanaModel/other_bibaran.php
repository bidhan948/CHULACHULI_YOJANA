<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class other_bibaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'plan_id',
        'type_id',
        'formation_start_date',
        'formation_start_date_eng',
        'start_date',
        'start_date_eng',
        'end_date',
        'end_date_eng',
        'committee_count',
        'house_family_count',
        'female',
        'male',
        'user_id',
        'agreement_date_nep',
        'agreement_date_eng',
        'work_order_date'
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function otherBibaranDetail(): HasMany
    {
        return $this->hasMany(other_bibaran_detail::class);
    }

    // over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
    }
    
    public function setFormationStartDateAttribute($value)
    {
        $this->attributes['formation_start_date'] = $value;
        $this->attributes['formation_start_date_eng'] = convertBsToAd($value);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value;
        $this->attributes['start_date_eng'] = convertBsToAd($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value;
        $this->attributes['end_date_eng'] = convertBsToAd($value);
    }

    public function setAgreementDateNepAttribute($value)
    {
        $this->attributes['agreement_date_nep'] = $value;
        $this->attributes['agreement_date_eng'] = convertBsToAd($value);
    }
}
