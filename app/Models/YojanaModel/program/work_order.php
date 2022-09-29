<?php

namespace App\Models\YojanaModel\program;

use App\Models\PisModel\Staff;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\list_registration_attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class work_order extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';
    
    protected $fillable = [
        'plan_id',
        'work_order_no',
        'name',
        'decision_date_nep',
        'decision_date_eng',
        'municipality_amount',
        'cost_participation',  // लागत सहभागित
        'cost_sharing',  // नगद साझेदारी
        'cost_sharing_name', // नगद साझेदारी नाम
        'date_nep',
        'date_eng',
        'program_start_date_nep',
        'program_start_date_eng',
        'program_end_date_nep',
        'program_end_date_eng',
        'work_order_budget',
        'list_registration_attribute_id',
        'house_family_count',
        'fiscal_year_id',
        'female',
        'male',
        'venue'
    ];

    public function Program(): BelongsTo
    {
        return $this->belongsTo(plan::class,'plan_id');
    }

    public function workOrderDetail(): HasMany
    {
        return $this->hasMany(work_order_detail::class)->orderBy('id');
    } 

    public function listRegistrationAttribute(): BelongsTo
    {
        return $this->belongsTo(list_registration_attribute::class);
    }

    public function programKulLagat(): HasMany
    {
        return $this->hasMany(program_kul_lagat::class);
    }

    public function programAdvance(): HasOne
    {
        return $this->hasOne(program_advance::class);
    }
    // using setter to assign english date
    public function setDateNepAttribute($value)
    {
        $this->attributes['date_nep'] = $value;
        $this->attributes['date_eng'] = convertBsToAd($value);
    }

    public function setDecisionDateNepAttribute($value)
    {
        $this->attributes['decision_date_nep'] = $value;
        $this->attributes['decision_date_eng'] = convertBsToAd($value);
    }

    public function setProgramStartDateNepAttribute($value)
    {
        $this->attributes['program_start_date_nep'] = $value;
        $this->attributes['program_start_date_eng'] = convertBsToAd($value);
    }

    public function setProgramEndDateNepAttribute($value)
    {
        $this->attributes['program_end_date_nep'] = $value;
        $this->attributes['program_end_date_eng'] = convertBsToAd($value);
    }

    //  over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->entered_by = auth()->id();
        });
    }
}
