<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'date'
    ];

    public function plan()
    {
        return $this->belongsTo(plan::class);
    }

    public function contract()
    {
        return $this->belongsTo(contract::class,'plan_id','plan_id');
    }


}
