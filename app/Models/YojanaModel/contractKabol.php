<?php

namespace App\Models\YojanaModel;

use App\Models\YojanaModel\setting\list_registration_attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class contractKabol extends Model
{
    use HasFactory;
    protected $table = 'contract_kabols';

    protected $connection = 'mysql_yojana';
    
    protected $fillable=[
        'plan_id',
        'contractor_name',
        'has_vat',
        'total_kabol_amount',
        'total_amount',
        'bank_guarantee',
        'bail_account_amount',
        'is_selected',
        'date',
        'list_registration_attribute_id'
    ];

    public function plan()
    {
        return $this->belongsTo(plan::class);
    }

    public function contract()
    {
        return $this->belongsTo(contract::class,'plan_id','plan_id');
    }

    public function listRegistrationAttribute(): BelongsTo
    {
        return $this->belongsTo(list_registration_attribute::class);
    }
}
