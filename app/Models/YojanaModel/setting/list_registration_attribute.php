<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class list_registration_attribute extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'list_registration_id',
        'name',
        'address',
        'contact_no',
        'post',
        'working_branch',
        'cit_no',
        'ward_no',
        'entered_by',
        'second_person_name',
        'remark'
    ];

    public function listRegistration(): BelongsTo
    {
        return $this->belongsTo(list_registration::class);
    }

    public function listRegistrationAttributeDetails(): HasMany
    {
        return $this->hasMany(list_registration_attribute_detail::class);
    }

  
    
    // overriding model for automatic assigning user id
    
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->entered_by = auth()->id();
        });
    }
}
