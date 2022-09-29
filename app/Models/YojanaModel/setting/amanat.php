<?php

namespace App\Models\YojanaModel\setting;

use App\Models\YojanaModel\plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class amanat extends Model
{
    use HasFactory,SoftDeletes;

    const NAMESPACE = 'App\Models\YojanaModel\setting\amanat';
    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'name',
        'ward_no',
        'cit_no',
        'issue_district',
        'mobile_no',
        'gender',
        'address',
        'plan_id',
        'entered_by',
        'fullname'
    ];

    // overriding model for automatic assigning user id

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->entered_by = auth()->id();
        });
    }

    public function types(): MorphMany
    {
        return $this->morphMany(type::class,'typeable');
    }

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }
}
