<?php

namespace App\Models\YojanaModel;

use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class other_bibaran_detail extends Model
{
    use HasFactory;

    protected $connection = 'mysql_yojana';

    protected $fillable = ['staff_id', 'post_id', 'other_bibaran_id'];

    public function otherBibaran(): BelongsTo
    {
        return $this->belongsTo(other_bibaran::class);
    }

    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'user_id');
    }

    public function staffServices(): HasOne
    {
        return $this->hasOne(StaffService::class, 'user_id', 'staff_id')->where('is_active',true);
    }
}
