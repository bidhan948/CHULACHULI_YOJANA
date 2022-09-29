<?php

namespace App\Models\YojanaModel\program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class program_kul_lagat extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_yojana';

    protected $fillable = [
        'work_order_id',
        'bibaran',
        'unit_id',
        'unit_price',
        'quantity',
        'total',
        'user_id'
    ];

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(work_order::class);
    }

    //  over riding orm to insert user id by default

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->user_id = auth()->id();
        });
    }
}
