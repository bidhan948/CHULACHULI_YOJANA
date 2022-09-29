<?php

namespace App\Models\YojanaModel\program;

use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class work_order_detail extends Model
{
    use HasFactory;

    protected $fillable = ['work_order_id', 'staff_id', 'post_id'];
    
    protected $connection = 'mysql_yojana';

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(work_order::class);
    }

    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class,'staff_id','user_id');
    }

    public function staffServices(): HasOne
    {
        return $this->hasOne(StaffService::class, 'user_id', 'staff_id')->where('is_active',true);
    }
}
