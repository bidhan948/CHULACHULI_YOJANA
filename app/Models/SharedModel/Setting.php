<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    use HasFactory;

    protected $connection = 'mysql_shared';
    protected $table = 'setup_settings';

    protected $fillable = [
        'name',
        'name_eng',
        'slug',
        'has_child',
        'cascading_parent_id',
        'can_be_updated_in_yojana',
        'can_be_updated_in_nagadi',
        'can_be_updated_in_sampatikar',
        'can_be_updated_in_dainik',
        'can_be_updated_in_krishi',
        'can_be_updated_in_apangata',
        'can_be_updated_in_naksa',
        'can_be_updated_in_byabasaye',
        'can_be_updated_in_malpot',
        'can_be_updated_in_pis',
    ];
    public $timestamps = false;

    public function scopeUpdatedIn($query, $value)
    {
        return $query->where('can_be_updated_in_' . $value, 1);
    }

    public function scopeSlug($query, $value)
    {
        return $query->where('slug', $value);
    }

    public function scopeParents($query)
    {
        return $query->where('has_child',1);
    }

    public function settingValues(): HasMany
    {
        return $this->hasMany(SettingValue::class);
    }
}
