<?php

namespace App\Models\YojanaModel;

use App\Models\SharedModel\SettingValue;
use App\Models\YojanaModel\program\work_order;
use App\Models\YojanaModel\setting\institutional_committee;
use App\Models\YojanaModel\consumer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'reg_no',
        'name',
        'fiscal_year_id',
        'expense_type_id',
        'type_id',
        'topic_area_type_id',
        'topic_id',
        'type_of_allocation_id',
        'grant_amount',
        'first_installment',
        'second_installment',
        'third_installment',
        'fourth_installment',
        'detail',
        'is_cancel',
        'added_by',
        'plan_id',
        'ward_no',
        'is_merge'
    ];

    public function wardDetail(): HasMany
    {
        return $this->hasMany(plan_ward_detail::class);
    }

    public function budgetSourcePlanDetails(): HasMany
    {
        return $this->hasMany(budget_source_plan::class);
    }
    
        public function type()
    {
        return $this->hasOne(type::class,'plan_id','id');
    }

    public function runningBillPayment(): HasOne
    {
        return $this->hasOne(running_bill_payment::class);
    }

    public function scopeCurrentFiscalYear($query)
    {
        return $query->where('fiscal_year_id', getCurrentFiscalYear(TRUE)->id);
    }

    public function planAllocation(): BelongsTo
    {
        return $this->belongsTo(SettingValue::class, 'type_of_allocation_id','id');
    }

    public function setGrantAmountAttribute($value)
    {
        $this->attributes['grant_amount'] = English($value);
    }

    public function kulLagat(): HasOne
    {
        return $this->hasOne(kul_lagat::class);
    }
    
        public function planWards()
    {
        return $this->hasMany(plan_ward_detail::class,'plan_id','id');
    }
    public function planOperate(): HasOne
    {
        return $this->hasOne(plan_operate::class);
    }

    public function planWardDetails(): HasMany
    {
        return $this->hasMany(plan_ward_detail::class);
    }

    public function Consumer(): HasOne
    {
        return $this->hasOne(consumer::class);
    }

    public function institutionalCommittee(): HasOne
    {
        return $this->hasOne(institutional_committee::class);
    }

    public function Topic() : BelongsTo
    {
        return $this->belongsTo(SettingValue::class,'topic_id','id');
    }

    // Referencing own class for yojana break down
    public function Parents(): HasMany
    {
        return $this->hasMany(plan::class);
    }

    public function workOrder(): HasMany
    {
        return $this->hasMany(work_order::class);
    }

    public function mergePlan(): HasMany
    {
        return $this->hasMany(merge_plan::class);
    }

    public function Advance(): HasOne
    {
        return $this->hasOne(advance::class);
    }

    public function otherBibaran(): HasOne
    {
        return $this->hasOne(other_bibaran::class);
    }

    public function finalPayment(): HasOne
    {
        return $this->hasOne(final_payment::class);
    }

    public function runningBillPayments(): HasMany
    {
        return $this->hasMany(running_bill_payment::class);
    }

    public function contracts() : HasOne
    {
        return $this->hasOne(contract::class);
    }

    public function contractOpens()
    {
        return $this->hasMany(contractOpen::class,'plan_id','id');
    }

    public function contractKabols()
    {
        return $this->hasMany(contractKabol::class,'plan_id','id');
    }
    // / over riding orm to insert user id by default
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->added_by = auth()->id();
        });
    }
}
