<?php

namespace App\Models\YojanaModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\deduction;

class running_bill_payment_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'plan_id',
        'running_bill_payment_id',
        'deduction_id',
        'deduction_percent',
        'deduction_amount'
    ];

    public function Plan(): BelongsTo
    {
        return $this->belongsTo(plan::class);
    }

    public function runningBillPayment(): BelongsTo
    {
        return $this->belongsTo(running_bill_payment::class);
    }

    public function Deduction(): BelongsTo
    {
        return $this->belongsTo(deduction::class);
    }
}
