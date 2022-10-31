<?php

namespace App\Models\YojanaModel\program;

use App\Models\YojanaModel\setting\deduction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class program_payment_final_deduction extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['program_final_payment_id', 'deduction_id', 'amount'];

    public function programFinalPayment(): BelongsTo
    {
        return $this->belongsTo(program_final_payment::class);
    }

    public function Deduction(): BelongsTo
    {
        return $this->belongsTo(deduction::class);
    }
}
