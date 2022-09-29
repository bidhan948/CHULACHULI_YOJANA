<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class consumer extends Model
{
    use HasFactory, SoftDeletes;

    const NAMESPACE = 'App\Models\YojanaModel\consumer';
    protected $fillable = ['name','plan_id','ward_no','entered_by'];
    protected $connection = 'mysql_yojana';

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }

    public function consumerDetails(): HasMany
    {
        return $this->hasMany(consumer_detail::class);
    }

    public function types(): MorphMany
    {
        return $this->morphMany(type::class,'typeable');
    }
}
