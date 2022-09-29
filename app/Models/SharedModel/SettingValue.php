<?php

namespace App\Models\SharedModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SettingValue extends Model
{
    use HasFactory;

    protected $connection = 'mysql_shared';
    protected $table = 'setup_setting_values';

    protected $fillable = [
        'name',
        'name_eng',
        'note',
        'setting_id',
        "cascading_parent_id",
        'is_deleted',
    ];
    public $timestamps = false;

    public function Parents(): HasMany
    {
        return $this->hasMany(SettingValue::class, 'cascading_parent_id');
    }
}
