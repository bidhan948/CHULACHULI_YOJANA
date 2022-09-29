<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetSource extends Model
{
    use HasFactory;
    protected $connection = 'mysql_yojana';
    protected $table = 'budget_sources';

    protected $fillable = ['name','fiscal_year_id'];

    public $timestamps = false;

    public function budget_source_deposit() {
        return $this->hasMany(BudgetSourceDeposit::class, 'budget_source_id');
    }

    public function budget_source_plan() {
        return $this->hasMany(budget_source_plan::class, 'budget_source_id');
    }
}
