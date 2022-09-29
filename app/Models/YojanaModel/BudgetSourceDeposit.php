<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetSourceDeposit extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';
    protected $table = "budget_source_deposits";
    protected $fillable = [
        'amount',
        'entry_index',
        'entry_date_eng',
        'entry_date_nep',
        'remarks',
        'status',
        'fiscal_year_id',
        'budget_source_id',
        'parent_id'
    ];
}
