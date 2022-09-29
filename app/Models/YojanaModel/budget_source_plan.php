<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class budget_source_plan extends Model
{
    use HasFactory;

    protected $table = 'budget_source_plans';
    protected $connection = 'mysql_yojana';
    
    protected $fillable = [
        'budget_source_id',
        'plan_id',
        'amount',
        'is_split',
        'is_merge'
    ];

    public function budgetSources()
    {
        return $this->belongsTo(BudgetSource::class, 'budget_source_id');
    }
}
