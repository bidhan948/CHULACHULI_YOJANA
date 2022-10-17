<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contractOpen extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';
    protected $table = 'contract_opens';
    protected $fillable=[
        'plan_id',
        'name',
        'bank_name',
        'bank_guarantee_amount',
        'bank_date',
        'bail_amount',
        'remark'
    ];
}
