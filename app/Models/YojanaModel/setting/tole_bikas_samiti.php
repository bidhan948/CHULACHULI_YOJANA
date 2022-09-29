<?php

namespace App\Models\YojanaModel\setting;

use App\Models\YojanaModel\type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class tole_bikas_samiti extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    const NAMESPACE = 'App\Models\YojanaModel\setting\tole_bikas_samiti';
    
    protected $fillable = [
        'name',
        'ward_no',
        'date_nep',
        'date_eng',
        'former_address',
        'former_ward_no',
        'entered_by',
        'exp_date_nep',
        'exp_date_eng',
        'reg_no'
    ];

    public function setEnteredByAttribute($value)
    {
        $this->attributes['entered_by'] = auth()->user()->id;
    }

    public function toleBikasSamitiDetails(): HasMany
    {
        return $this->hasMany(tole_bikas_samiti_detail::class);
    }

    public function setDateNepAttribute($value)
    {
        $this->attributes['date_nep'] = $value;
        $this->attributes['date_eng'] = convertBsToAd($value);
    }

    public function types(): MorphMany
    {
        return $this->morphMany(type::class,'typeable');
    }
}
