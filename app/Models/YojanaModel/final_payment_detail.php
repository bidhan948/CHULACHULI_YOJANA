<?php

namespace App\Models\YojanaModel;

use App\Models\YojanaModel\setting\deduction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class final_payment_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'final_payment_id',
        'deduction_id',
        'deduction_percent',
        'deduction_amount',
    ];

    public function Deduction(): BelongsTo
    {
        return $this->belongsTo(deduction::class);
    }
}
