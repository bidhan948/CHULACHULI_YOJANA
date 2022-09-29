<?php

namespace App\Models\YojanaModel;

use App\Models\YojanaModel\plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class kul_lagat extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_yojana';
    
    protected $fillable = [
        'napa_amount',
        'contingency_amount',
        'plan_id',
        'napa_contingency',
        'other_office_con',
        'other_office_con_contingency',
        'other_office_con_name',
        'other_office_agreement',
        'other_agreement_contingency',
        'other_contingency_con_name',
        'customer_agreement',
        'customer_agreement_contingency',
        'work_order_budget',
        'consumer_budget',
        'total_investment',
        'type_id',
        'unit_id',
        'quantity'
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }
}
