<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class institutional_committee extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    const NAMESPACE = 'App\Models\YojanaModel\setting\institutional_committee';

    protected $fillable = ['name', 'entered_by', 'ward_no', 'plan_id'];

    public function institutionalCommitteeDetail(): HasMany
    {
        return $this->hasMany(institutional_committee_detail::class);
    }

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
}
