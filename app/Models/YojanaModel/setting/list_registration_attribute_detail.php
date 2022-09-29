<?php

namespace App\Models\YojanaModel\setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class list_registration_attribute_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'list_registration_attribute_id',
        'contact_no',
        'post_id',
        'name',
        'ward_no',
        'gender',
        'cit_no',
        'issue_district'
    ];

    public function listRegistrationAttribute(): BelongsTo
    {
        return $this->belongsTo(list_registration_attribute::class);
    }
}
