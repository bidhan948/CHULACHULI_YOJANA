<?php

namespace App\Models\YojanaModel;

use App\Models\YojanaModel\setting\list_registration_attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class contractOpen extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';
    protected $table = 'contract_opens';
    protected $fillable = [
        'plan_id',
        'name',
        'bank_name',
        'bank_guarantee_amount',
        'bank_date',
        'bail_amount',
        'remark',
        'list_registration_attribute_id'
    ];

    public function listRegistrationAttribute(): BelongsTo
    {
        return $this->belongsTo(list_registration_attribute::class);
    }
}
