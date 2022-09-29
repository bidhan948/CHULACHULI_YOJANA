<?php

namespace App\Models\YojanaModel\program;

use App\Models\PisModel\Staff;
use App\Models\YojanaModel\plan;
use App\Models\YojanaModel\setting\list_registration_attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class program_payment_final extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';
    
    protected $fillable = [
        'plan_id',
        'work_order_id',
        'paid_date',
        'bill_amount',
        'bhuktani_ghati_katti_rakam',
        'mu_tax',
        'b_tax',
        'total_katti_amount',
        'program_advance',
        'net_total_amount',
        'is_final_payment'
    ];
    
    public $timestamps = false;

    public function Program(): BelongsTo
    {
        return $this->belongsTo(plan::class,'plan_id');
    }
}
