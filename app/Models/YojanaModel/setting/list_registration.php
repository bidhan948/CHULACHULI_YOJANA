<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class list_registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['name'];


    public function listRegistrationAttribute(): HasMany
    {
        return $this->hasMany(list_registration_attribute::class);
    }
}
