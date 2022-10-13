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
        'bail_account_amount'
    ];


}
